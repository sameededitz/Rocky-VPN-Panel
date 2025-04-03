<div class="row layout-top-spacing">
    <!-- VPS Servers -->
    <div class="col-xl-4 col-lg-12 col-md-12 col-sm-12 col-12 layout-spacing">
        <div class="widget widget-six">
            <div class="widget-heading">
                <h4 class="mb-4">VPS Servers</h4>
            </div>
            <div class="widget-content d-flex align-items-center justify-content-between">
                <div class="total-vps">
                    <h6 class="w-title">Total VPS Servers</h6>
                    <span class="badge badge-light-info">{{ $totalVpsServers }}</span>
                </div>
                <div class="total-vps">
                    <h6 class="w-title">Active Servers</h6>
                    <span class="badge badge-light-success">{{ $activeVpsServers }}</span>
                </div>
            </div>
        </div>
    </div>
    {{-- <div class="col-xl-4 col-lg-12 col-md-12 col-sm-12 col-12 layout-spacing">
        <div class="widget widget-six">
            <div class="card-body">
                <div class="d-flex flex-wrap align-items-center justify-content-between gap-3">
                    <div>
                        <p class="fw-medium fs-5 mb-1 text-info">Total Users</p>
                        <h4 class="mb-0">{{ $totalUsers }}</h4>
                    </div>
                    <div
                        class="btn-light-info btn-rounded btn-icon d-inline-flex align-items-center p-2">
                        <iconify-icon icon="gridicons:multiple-users" class="text-2xl mb-0" width="30" height="30"></iconify-icon>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}

    <!-- VPN Servers -->
    <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12 col-12 layout-spacing">
        <div class="widget widget-six">
            <div class="widget-heading">
                <h4 class="mb-4">VPN Servers</h4>
            </div>
            <div class="widget-content d-flex align-items-center justify-content-between">
                <div class="total-vpn">
                    <h6 class="w-title">Total VPN Servers</h6>
                    <span class="badge badge-light-info">{{ $totalVpnServers }}</span>
                </div>
                <div class="total-vpn">
                    <h6 class="w-title">Active Servers</h6>
                    <span class="badge badge-light-success">{{ $activeVpnServers }}</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Users -->
    <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12 col-12 layout-spacing">
        <div class="widget widget-six">
            <div class="widget-heading">
                <h4 class="mb-4">Users ({{ $totalUsers }}) </h4>
            </div>
            <div class="widget-content d-flex align-items-center justify-content-between">
                <div class="total-users">
                    <h6 class="w-title">Admins</h6>
                    <span class="badge badge-light-info">{{ $adminsCount }}</span>
                </div>
                <div class="total-users">
                    <h6 class="w-title">Users</h6>
                    <span class="badge badge-light-success">{{ $usersCount }}</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Total Purchases -->
    <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12 col-12 layout-spacing">
        <div class="widget widget-card-five">
            <div class="widget-heading">
                <h4 class="mb-4">Total Purchases</h4>
            </div>
            <div class="widget-content">
                <div class="account-box">
                    <div class="info-box">
                        <div class="balance-info">
                            <p>{{ $totalPurchases }}</p>
                        </div>
                    </div>
                    <div class="card-bottom-section mt-0 text-end justify-content-end">
                        <a href="{{ route('purchases') }}" class="">View Purchases</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Revenue -->
    <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12 col-12 layout-spacing">
        <div class="widget widget-card-five">
            <div class="widget-heading">
                <h4 class="mb-4">Revenue</h4>
            </div>
            <div class="widget-content">
                <div class="account-box">
                    <div class="info-box">
                        <div class="balance-info">
                            <p>${{ number_format($totalRevenue, 2) }}</p>
                        </div>
                    </div>
                    <div class="card-bottom-section mt-0 text-end justify-content-end">
                        <a href="{{ route('purchases') }}" class="">View Revenue</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
