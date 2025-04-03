<?php

use App\Livewire\Auth\Login;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VerifyController;
use App\Livewire\Actions\Logout;

Route::middleware('guest')->group(function () {
    Route::get('/login', Login::class)->name('login');
});
Route::middleware('auth')->group(function () {
    Route::get('/email/verify/{id}/{hash}', [VerifyController::class, 'verify'])->middleware(['signed', 'throttle:6,1'])->withoutMiddleware(['auth'])->name('verification.verify');

    Route::post('/logout', Logout::class)->name('logout');
});

Route::get('email/verify/view/{id}/{hash}', [VerifyController::class, 'viewEmail'])->name('email.verification.view');