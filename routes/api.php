<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\VerifyController;
use App\Http\Controllers\Api\PurchaseController;
use App\Http\Controllers\Api\ResourceController;

Route::middleware('guest')->group(function () {
    Route::post('/login', [AuthController::class, 'login'])->name('api.login');

    Route::post('/signup', [AuthController::class, 'signup'])->name('api.signup');

    // Route::post('/reset-password', [VerifyController::class, 'sendResetLink'])->name('api.reset.password');

    Route::post('/email/resend-verification', [VerifyController::class, 'resendEmail'])->name('api.verify.resend');
});

Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/user', [UserController::class, 'user'])->name('api.user');

    Route::post('/logout', [AuthController::class, 'logout'])->name('api.logout');

    Route::get('/purchase/active', [PurchaseController::class, 'active'])->name('api.plan.active');

    Route::get('/purchase/history', [PurchaseController::class, 'history'])->name('api.plan.history');

    Route::post('/purchase/add', [PurchaseController::class, 'addPurchase'])->name('api.add.purchase');

    Route::get('/servers', [ResourceController::class, 'servers']);

    Route::get('/nearby-servers', [ResourceController::class, 'nearestServer']);
});
Route::get('/vps-servers', [ResourceController::class, 'vpsServers']);

Route::get('/plans', [ResourceController::class, 'plans']);