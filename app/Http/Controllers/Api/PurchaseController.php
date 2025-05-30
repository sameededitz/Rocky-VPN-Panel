<?php

namespace App\Http\Controllers\Api;

use Carbon\Carbon;
use App\Models\Plan;
use Illuminate\Http\Request;
use App\Models\StripeSession;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\PurchaseResource;
use Illuminate\Support\Facades\Validator;

class PurchaseController extends Controller
{
    public function addPurchase(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'plan_id' => 'required|exists:plans,id',
            'payment_intent' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => $validator->errors()->all(),
            ], 400);
        }

        $user = Auth::user();
        /** @var \App\Models\User $user **/

        $paymentIntent = $request->payment_intent;
        if ($paymentIntent) {
            $existingSession = StripeSession::where('payment_intent', $paymentIntent)->first();

            if ($existingSession) {
                return response()->json([
                    'status' => true,
                    'message' => 'Purchase already processed!',
                ], 200);
            }
        }

        $plan = Plan::findOrFail($request->plan_id);

        /** @var \App\Models\Purchase $purchase **/
        $purchase = $user->purchases()
            ->where('status', 'active')
            ->where('end_date', '>', now())
            ->first();

        $duration = $plan->duration;

        if ($purchase) {
            $newEndDate = $this->calculateExpiration(
                Carbon::parse($purchase->end_date),
                $plan->duration,
                $plan->duration_unit
            );

            // Update the purchase with the new expiration date
            $purchase->update([
                'plan_id' => $plan->id,
                'end_date' => $newEndDate,
                'status' => 'active',
            ]);

            $message = 'Purchase Extended successfully!';
        } else {
            $expiresAt = $this->calculateExpiration(now(), $duration, $plan->duration_unit);
            // Create a new purchase
            $purchase = $user->purchases()->create([
                'plan_id' => $plan->id,
                'amount_paid' => $plan->price,
                'start_date' => now(),
                'end_date' => $expiresAt,
                'status' => 'active',
            ]);

            $message = 'Purchase created successfully!';
        }

        if ($paymentIntent) {
            StripeSession::create([
                'payment_intent' => $paymentIntent,
                'user_id' => $user->id,
                'purchase_id' => $purchase->id,
            ]);
        }

        return response()->json([
            'status' => true,
            'message' => $message,
            'purchase' => new PurchaseResource($purchase->load('user', 'plan')),
        ], 200);
    }

    public function active()
    {
        /** @var \App\Models\User $user **/
        $user = Auth::user();
        $activePlan = $user->purchases()
            ->where('status', 'active')
            ->where('end_date', '>', now())
            ->with('plan', 'user')
            ->first();

        if (!$activePlan) {
            return response()->json([
                'status' => false,
                'message' => 'No active plan found.'
            ], 404);
        }

        return response()->json([
            'status' => true,
            'message' => 'Active plan found.',
            'plan' => new PurchaseResource($activePlan),
        ], 200);
    }

    public function viewPurchase($id)
    {
        /** @var \App\Models\User $user **/
        $user = Auth::user();
        $purchase = $user->purchases()
            ->where('id', $id)
            ->with('plan', 'user')
            ->first();

        if (!$purchase) {
            return response()->json([
                'status' => false,
                'message' => 'Purchase not found.'
            ], 404);
        }

        return response()->json([
            'status' => true,
            'message' => 'Purchase found.',
            'purchase' => new PurchaseResource($purchase),
        ], 200);
    }

    public function history()
    {
        /** @var \App\Models\User $user **/
        $user = Auth::user();
        $purchases = $user->purchases()->with('plan')->latest()->paginate(5);
        return PurchaseResource::collection($purchases);
    }

    private function calculateExpiration($startDate, $duration, $unit)
    {
        return match ($unit) {
            'day'   => $startDate->addDays($duration),
            'week'  => $startDate->addWeeks($duration),
            'month' => $startDate->addMonths($duration),
            'year'  => $startDate->addYears($duration),
            default => $startDate->addDays(7),
        };
    }
}
