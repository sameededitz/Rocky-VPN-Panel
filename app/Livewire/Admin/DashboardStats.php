<?php

namespace App\Livewire\Admin;

use App\Models\Plan;
use App\Models\User;
use App\Models\Server;
use Livewire\Component;
use App\Models\Purchase;
use App\Models\VpsServer;

class DashboardStats extends Component
{
    public $totalVpsServers, $activeVpsServers;
    public $totalVpnServers, $activeVpnServers;
    public $totalUsers, $adminsCount, $usersCount;
    public $totalPlans;
    public $totalPurchases, $totalRevenue, $totalBalance;

    public function mount()
    {
        $this->totalVpsServers = VpsServer::count();
        $this->activeVpsServers = VpsServer::where('status', 'active')->count();

        $this->totalVpnServers = Server::count();
        $this->activeVpnServers = Server::where('status', 'active')->count();

        $this->totalUsers = User::count();
        $this->adminsCount = User::where('role', 'admin')->count();
        $this->usersCount = User::where('role', 'admin')->count();

        $this->totalPlans = Plan::count();

        $this->totalPurchases = Purchase::count();
        $this->totalRevenue = Purchase::where('status', 'active')->sum('amount_paid');
    }

    public function render()
    {
        return view('livewire.admin.dashboard-stats');
    }
}
