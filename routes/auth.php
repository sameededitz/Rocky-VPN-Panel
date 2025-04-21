<?php

use App\Livewire\Auth\Login;
use App\Livewire\Actions\Logout;
use App\Livewire\Auth\ResetPassword;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VerifyController;

Route::middleware('guest')->group(function () {
    Route::get('/login', Login::class)->name('login');

    Route::get('/reset-password/{token}', ResetPassword::class)->name('password.reset');
});
Route::middleware('auth')->group(function () {
    Route::post('/logout', Logout::class)->name('logout');
});

Route::get('email/verify/view/{id}/{hash}', [VerifyController::class, 'viewEmail'])->name('email.verification.view');