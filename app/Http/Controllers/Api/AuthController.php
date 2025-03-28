<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Jobs\SendEmailVerification;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\RateLimiter;

class AuthController extends Controller
{
    public function signup(Request $request)
    {
        $this->ensureIsNotRateLimited($request);

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255|min:3',
            'email' => 'required|email|unique:users,email',
            'password' => [
                'required',
                Password::min(8)
                    ->letters()
                    ->mixedCase()
                    ->numbers()
                    ->symbols()
                    ->uncompromised()
            ]
        ]);

        if ($validator->fails()) {
            RateLimiter::hit($this->throttleKey($request));

            return response()->json([
                'status' => false,
                'message' => $validator->errors()->all()
            ], 400);
        }

        /** @var \App\Models\User $user **/
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'user'
        ]);

        SendEmailVerification::dispatch($user)->delay(now()->addSeconds(5));

        RateLimiter::hit($this->throttleKey($request));

        return response()->json([
            'status' => true,
            'message' => 'User created successfully! Verify your Email',
            'user' => new UserResource($user),
        ], 201);
    }

    public function login(Request $request)
    {
        $this->ensureIsNotRateLimited($request);

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'password' => 'required|min:8'
        ]);

        if ($validator->fails()) {
            RateLimiter::hit($this->throttleKey($request));

            return response()->json([
                'status' => false,
                'message' => $validator->errors()->all()
            ], 400);
        }

        $loginType = filter_var($request->name, FILTER_VALIDATE_EMAIL) ? 'email' : 'name';
        $user = User::where($loginType, $request->name)->first();
        if (!$user) {
            RateLimiter::hit($this->throttleKey($request));
            return response()->json([
                'status' => false,
                'message' => "We couldn't find an account with that " . ($loginType == 'email' ? 'email' : 'username') . "."
            ], 400);
        }

        if (!$user->hasVerifiedEmail()) {
            RateLimiter::hit($this->throttleKey($request));
            return response()->json([
                'status' => false,
                'message' => 'Please verify your email address.',
                'user' => $user
            ], 400);
        }

        $credentials = [
            $loginType => $request->name,
            'password' => $request->password,
        ];
        $remember = $request->has('remember');

        if (!Auth::attempt($credentials, $remember)) {
            RateLimiter::hit($this->throttleKey($request));

            return response()->json([
                'status' => false,
                'message' => __('auth.failed')
            ], 400);
        }

        RateLimiter::clear($this->throttleKey($request));

        $user = Auth::user();
        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'status' => true,
            'message' => 'User logged in successfully!',
            'user' => $user,
            'access_token' => $token,
            'token_type' => 'Bearer',
        ], 200);
    }

    public function logout()
    {
        $user = Auth::user();
        /** @var \App\Models\User $user **/
        $user->tokens()->delete();

        return response()->json([
            'status' => true,
            'message' => 'User logged out successfully!'
        ], 200);
    }

    protected function ensureIsNotRateLimited(Request $request): void
    {
        if (!RateLimiter::tooManyAttempts($this->throttleKey($request), 5)) {
            return;
        }

        $seconds = RateLimiter::availableIn($this->throttleKey($request));

        throw new \Illuminate\Http\Exceptions\ThrottleRequestsException(
            __("auth.throttle", ['seconds' => $seconds, 'minutes' => ceil($seconds / 60)])
        );
    }

    protected function throttleKey(Request $request): string
    {
        return Str::lower($request->name) . '|' . $request->ip();
    }
}
