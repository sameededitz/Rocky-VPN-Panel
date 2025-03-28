<?php

namespace App\Livewire\Admin;

use Carbon\Carbon;
use App\Models\Plan;
use App\Models\User;
use Livewire\Component;

class ManageUser extends Component
{
    public User $user;
    public $plans, $selectedPlan;

    public function mount(User $user)
    {
        $this->user = $user;
        $this->plans = Plan::all();
    }

    public function addPlan()
    {
        $plan = Plan::findOrFail($this->selectedPlan);
        $activePurchase = $this->user->activePlan;

        // Maximum allowed date (MySQL's DATETIME limit)
        $maxDate = Carbon::create(2038, 1, 19, 3, 14, 7);

        if ($activePurchase) {
            $currentExpiresAt = Carbon::parse($activePurchase->end_date);
            $newExpiresAt = match ($plan->duration_unit) {
                'day' => $currentExpiresAt->addDays($plan->duration),
                'week' => $currentExpiresAt->addWeeks($plan->duration),
                'month' => $currentExpiresAt->addMonths($plan->duration),
                'year' => $currentExpiresAt->addYears($plan->duration),
                default => $currentExpiresAt->addDays(7),
            };

            if ($newExpiresAt->greaterThan($maxDate)) {
                $newExpiresAt = $maxDate;
            }

            $activePurchase->update([
                'plan_id' => $plan->id,
                'amount_paid' => $activePurchase->amount_paid + $plan->price,
                'end_date' => $newExpiresAt
            ]);

            $message = 'Plan extended successfully!';
        } else {
            $expiresAt = match ($plan->duration_unit) {
                'day' => now()->addDays($plan->duration),
                'week' => now()->addWeeks($plan->duration),
                'month' => now()->addMonths($plan->duration),
                'year' => now()->addYears($plan->duration),
                default => now()->addDays(7),
            };

            if ($expiresAt->greaterThan($maxDate)) {
                $expiresAt = $maxDate;
            }

            $this->user->purchases()->create([
                'plan_id' => $plan->id,
                'amount_paid' => $plan->price,
                'start_date' => now(),
                'end_date' => $expiresAt,
                'status' => 'active',
            ]);

            $message = 'Plan added successfully!';
        }

        $this->selectedPlan = null;

        $this->user->refresh();

        $this->dispatch('snackbar', message: $message, type: 'success');
    }

    public function cancelPurchase()
    {
        if ($this->user->activePlan) {
            $this->user->activePlan->update(['status' => 'cancelled']);
            $message = 'Purchase cancelled successfully!';
            $this->dispatch('snackbar', message: $message, type: 'success');
        } else {
            $message = 'No active purchase found!';
            $this->dispatch('snackbar', message: $message, type: 'error');
        }

        $this->user->refresh();
    }

    public function render()
    {
        /** @disregard @phpstan-ignore-line */
        return view('livewire.admin.manage-user')
            ->extends('layouts.app')
            ->section('content');
    }
}
