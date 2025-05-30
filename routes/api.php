<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\VerifyController;
use App\Http\Controllers\Api\PurchaseController;
use App\Http\Controllers\Api\ResourceController;
use App\Http\Controllers\Api\BillingAddressController;

Route::middleware('guest')->group(function () {
    Route::post('/login', [AuthController::class, 'login'])->name('api.login');

    Route::post('/signup', [AuthController::class, 'signup'])->name('api.signup');

    Route::post('/forgot-password', [VerifyController::class, 'sendResetLink'])->middleware('throttle:10,1')->name('api.reset.password');

    Route::post('/reset-password', [VerifyController::class, 'resetPassword'])->middleware('throttle:10,1')->name('password.reset');

    Route::post('/email/resend-verification', [VerifyController::class, 'resendEmail'])->name('api.verify.resend');

    Route::get('/email/verify/{id}/{hash}', [VerifyController::class, 'verifyEmail'])->name('verification.verify');

    Route::get('/web/servers', [ResourceController::class, 'webServers'])->name('api.web.servers');
});

Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/user', [UserController::class, 'user'])->name('api.user');

    Route::post('/user/update', [UserController::class, 'updateProfile'])->name('api.profile.update');

    Route::post('/user/update-password', [UserController::class, 'updatePassword'])->name('api.profile.update.password');

    Route::delete('/user/delete', [UserController::class, 'deleteAccount'])->name('api.profile.delete');

    Route::post('/logout', [AuthController::class, 'logout'])->name('api.logout');

    Route::get('/purchase/active', [PurchaseController::class, 'active'])->name('api.plan.active');

    Route::get('/purchase/history', [PurchaseController::class, 'history'])->name('api.plan.history');

    Route::get('/purchase/{id}', [PurchaseController::class, 'viewPurchase'])->name('api.plan.show');

    Route::post('/purchase/add', [PurchaseController::class, 'addPurchase'])->name('api.add.purchase');

    Route::get('/servers', [ResourceController::class, 'servers']);

    Route::get('/nearest-server', [ResourceController::class, 'nearestServer']);

    Route::post('/feedback/store', [ResourceController::class, 'addFeedback'])->name('api.feedback.add');

    Route::get('/billing-address', [BillingAddressController::class, 'show'])->name('api.billing.address.show');

    Route::post('/billing-address/store', [BillingAddressController::class, 'store'])->name('api.billing.address.store');

    Route::delete('/billing-address/delete', [BillingAddressController::class, 'destroy'])->name('api.billing.address.delete');
});
Route::get('/vps-servers', [ResourceController::class, 'vpsServers']);

Route::get('/plans', [ResourceController::class, 'plans']);

Route::get('/options', [ResourceController::class, 'options']);