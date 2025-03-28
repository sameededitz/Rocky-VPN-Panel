<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\VpsServer;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        return view('admin.dashboard');
    }

    public function users()
    {
        return view('admin.all-users');
    }

    public function admins()
    {
        return view('admin.all-admins');
    }

    public function vpsManager(VpsServer $server)
    {
        return view('admin.vps-manager', compact('server'));
    }
}
