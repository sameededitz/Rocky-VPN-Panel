<?php

use App\Livewire\Auth\ResetPassword;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;

Route::get('/', function () {
    if (Auth::check()) {
        return redirect()->route('dashboard');
    } else {
        return redirect()->route('login');
    }
})->name('home');

require __DIR__ . '/auth.php';
require __DIR__ . '/admin.php';

Route::get('/test/{token}', ResetPassword::class);

Route::get('/migrate-fresh', function () {
    Artisan::call('migrate:fresh');
    Artisan::call('db:seed');
    return "Migrated fresh and seeded";
});

Route::get('/migrate', function () {
    Artisan::call('migrate');
    return "Migrated";
});

Route::get('/seed', function () {
    Artisan::call('db:seed');
    return "Seeded";
});

Route::get('/optimize-clear', function () {
    Artisan::call('optimize:clear');
    return "Cleared";
});

Route::get('/optimize', function () {
    Artisan::call('optimize');
    return "Optimized";
});

Route::get('/storage-link', function () {
    Artisan::call('storage:link');
    return "Linked";
});