<?php

use App\Livewire\Admin\UserAdd;
use App\Livewire\Admin\UserEdit;
use App\Livewire\Admin\ServerAdd;
use App\Livewire\Admin\AllServers;
use App\Livewire\Admin\ManageUser;
use App\Livewire\Admin\ServerEdit;
use App\Livewire\Admin\SubServerAdd;
use App\Livewire\Admin\VpsServerAdd;
use App\Livewire\Admin\AllSubServers;
use App\Livewire\Admin\AllVpsServers;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Livewire\Admin\AllPlans;
use App\Livewire\Admin\AllSubSubServers;
use App\Livewire\Admin\PlanAdd;
use App\Livewire\Admin\PlanEdit;
use App\Livewire\Admin\SubServerEdit;
use App\Livewire\Admin\SubSubServerAdd;
use App\Livewire\Admin\SubSubServerEdit;

Route::group(['middleware' => ['auth']], function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/vps-servers', AllVpsServers::class)->name('vps-servers');
    Route::get('/vps-server/create', VpsServerAdd::class)->name('vps-server.create');
    Route::get('/vps-server/{server}/manage', [DashboardController::class, 'vpsManager'])->name('vps-server.manage');

    Route::get('/servers', AllServers::class)->name('servers');
    Route::get('/server/create', ServerAdd::class)->name('server.create');
    Route::get('/server/{server}/update', ServerEdit::class)->name('server.edit');

    Route::get('/server/{server}/sub-servers', AllSubServers::class)->name('sub-servers');
    Route::get('/server/{server}/sub-server/create', SubServerAdd::class)->name('sub-server.create');
    Route::get('/server/{server}/sub-server/{subServer}/update', SubServerEdit::class)->name('sub-server.edit');

    Route::get('/sub-server/{subServer}/sub-sub-servers', AllSubSubServers::class)->name('sub-sub-servers');
    Route::get('/sub-server/{subServer}/sub-sub-server/create', SubSubServerAdd::class)->name('sub-sub-server.create');
    Route::get('/sub-server/{subServer}/sub-sub-server/{subSubServer}/update', SubSubServerEdit::class)->name('sub-sub-server.edit');

    Route::get('/plans', AllPlans::class)->name('plans');
    Route::get('/plan/create', PlanAdd::class)->name('plan.create');
    Route::get('/plan/{plan}/update', PlanEdit::class)->name('plan.edit');

    Route::get('/users', [DashboardController::class, 'users'])->name('users');
    Route::get('/users/{user}', ManageUser::class)->name('user.manage');
    Route::get('/user/create', UserAdd::class)->name('user.create');
    Route::get('/user/{user}/update', UserEdit::class)->name('user.edit');

    Route::get('/admins', [DashboardController::class, 'admins'])->name('admins');
    Route::get('/admins/{user}', ManageUser::class)->name('admin.manage');
    Route::get('/admin/create', UserAdd::class)->name('admin.add');
    Route::get('/admin/{user}/update', UserEdit::class)->name('admin.edit');
});