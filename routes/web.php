<?php

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

Route::get('/test', function () {
    return view('auth.verified-email');
});

Route::get('/migrate-fresh', function () {
    Artisan::call('migrate:fresh');
    Artisan::call('db:seed');
});

Route::get('/migrate', function () {
    Artisan::call('migrate');
});

Route::get('/optimize-clear', function () {
    Artisan::call('optimize:clear');
});

Route::get('/optimize', function () {
    Artisan::call('optimize');
});

Route::get('/storage-link', function () {
    Artisan::call('storage:link');
});