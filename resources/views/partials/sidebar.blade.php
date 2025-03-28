<!--  BEGIN SIDEBAR  -->
<div class="sidebar-wrapper sidebar-theme">
    <nav id="sidebar">
        <div class="navbar-nav theme-brand flex-row  text-center">
            <div class="nav-logo">
                <div class="nav-item theme-logo">
                    <a href="./index.html">
                        <img src="{{ asset('src/assets/img/logo.svg') }}" class="navbar-logo" alt="logo">
                    </a>
                </div>
                <div class="nav-item theme-text">
                    <a href="./index.html" class="nav-link"> {{ config('app.name') }} </a>
                </div>
            </div>
            <div class="nav-item sidebar-toggle">
                <div class="btn-toggle sidebarCollapse">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" class="feather feather-chevrons-left">
                        <polyline points="11 17 6 12 11 7"></polyline>
                        <polyline points="18 17 13 12 18 7"></polyline>
                    </svg>
                </div>
            </div>
        </div>

        <ul class="list-unstyled menu-categories" id="accordionExample">
            <li class="menu {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                <a href="{{ route('dashboard') }}" class="dropdown-toggle" aria-expanded="false">
                    <div class="d-flex align-items-center gap-2">
                        <Iconify-icon icon="solar:home-smile-angle-outline" class="flex-shrink-0" width="20"
                            height="20"></Iconify-icon>
                        <span class="menu-text flex-grow-1">Dashboard</span>
                    </div>
                </a>
            </li>

            <li class="menu menu-heading d-inline">
                <div class="heading"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" class="feather feather-minus">
                        <line x1="5" y1="12" x2="19" y2="12"></line>
                    </svg><span>APPLICATIONS</span></div>
            </li>

            <li class="menu {{ request()->routeIs('vps-servers') ? 'active' : '' }}">
                <a href="{{ route('vps-servers') }}" class="dropdown-toggle" aria-expanded="false">
                    <div class="d-flex align-items-center gap-2">
                        <Iconify-icon icon="qlementine-icons:server-16" class="flex-shrink-0" width="20" height="20"></Iconify-icon>
                        <span class="menu-text flex-grow-1">VPS Servers</span>
                    </div>
                </a>
            </li>

            <li class="menu {{ request()->routeIs('servers') ? 'active' : '' }}">
                <a href="{{ route('servers') }}" class="dropdown-toggle" aria-expanded="false">
                    <div class="d-flex align-items-center gap-2">
                        <Iconify-icon icon="ic:baseline-vpn-lock" class="flex-shrink-0" width="20" height="20"></Iconify-icon>
                        <span class="menu-text flex-grow-1">VPN Servers</span>
                    </div>
                </a>
            </li>

            <li class="menu {{ request()->routeIs('plans') ? 'active' : '' }}">
                <a href="{{ route('plans') }}" class="dropdown-toggle" aria-expanded="false">
                    <div class="d-flex align-items-center gap-2">
                        <Iconify-icon icon="mdi:currency-usd" class="flex-shrink-0" width="20" height="20"></Iconify-icon>
                        <span class="menu-text flex-grow-1">Plans</span>
                    </div>
                </a>
            </li>

            <li class="menu {{ request()->routeIs('purchases') ? 'active' : '' }}">
                <a href="{{ route('purchases') }}" class="dropdown-toggle" aria-expanded="false">
                    <div class="d-flex align-items-center gap-2">
                        <Iconify-icon icon="streamline:receipt" class="flex-shrink-0" width="20" height="20"></Iconify-icon>
                        <span class="menu-text flex-grow-1">Purchases</span>
                    </div>
                </a>
            </li>

            <li class="menu {{ request()->routeIs('users') ? 'active' : '' }}">
                <a href="{{ route('users') }}" class="dropdown-toggle" aria-expanded="false">
                    <div class="d-flex align-items-center gap-2">
                        <Iconify-icon icon="ri:user-line" class="flex-shrink-0" width="20" height="20"></Iconify-icon>
                        <span class="menu-text flex-grow-1">Users</span>
                    </div>
                </a>
            </li>

            <li class="menu {{ request()->routeIs('admins') ? 'active' : '' }}">
                <a href="{{ route('admins') }}" class="dropdown-toggle" aria-expanded="false">
                    <div class="d-flex align-items-center gap-2">
                        <Iconify-icon icon="ri:admin-line" class="flex-shrink-0" width="20" height="20"></Iconify-icon>
                        <span class="menu-text flex-grow-1">Admins</span>
                    </div>
                </a>
            </li>
        </ul>

    </nav>
</div>
<!--  END SIDEBAR  -->
