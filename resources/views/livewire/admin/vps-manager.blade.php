<div>
    <div class="row layout-top-spacing">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 text-end">
            <button type="button" x-on:click="$wire.$refresh()"
                class="btn btn-outline-info _effect--ripple waves-effect waves-light">
                Recalculate Usage
            </button>
        </div>
    </div>
    <div class="row mt-2">
        <!-- CPU Usage -->
        <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12 col-12 layout-spacing">
            <div class="widget widget-six">
                <div class="widget-heading">
                    <h6 class="mb-1">CPU Usage</h6>
                </div>
                <div class="w-chart align-items-center justify-content-center" wire:ignore>
                    <div id="cpu-chart"></div>
                </div>
            </div>
        </div>

        <!-- RAM Usage -->
        <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12 col-12 layout-spacing">
            <div class="widget widget-six">
                <div class="widget-heading">
                    <h6 class="mb-1">RAM Usage</h6>
                </div>
                <div class="w-chart align-items-center justify-content-center" wire:ignore>
                    <div id="ram-chart"></div>
                </div>
            </div>
        </div>

        <!-- Disk Usage -->
        <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12 col-12 layout-spacing">
            <div class="widget widget-six">
                <div class="widget-heading">
                    <h6 class="mb-1">Disk Usage</h6>
                </div>
                <div class="w-chart align-items-center justify-content-center" wire:ignore>
                    <div id="disk-chart"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-2">
        <!-- WireGuard Status -->
        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12 layout-spacing">
            <div class="widget widget-six status-card">
                <div class="widget-heading d-flex justify-content-between align-items-center">
                    <h6 class="mb-1">WireGuard</h6>
                    <span
                        class="badge badge-light-{{ $wireguardStatus == 'Running' ? 'success' : 'danger' }}">{{ $wireguardStatus == 'Running' ? 'Running' : 'Not Running' }}</span>
                </div>
                <div class="users-connected">
                    {{ $wireguardConnectedUsers }} Users
                </div>
            </div>
        </div>

        <!-- IKEv2 Status -->
        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12 layout-spacing">
            <div class="widget widget-six status-card">
                <div class="widget-heading d-flex justify-content-between align-items-center">
                    <h6 class="mb-1">IKEv2</h6>
                    <span
                        class="badge badge-light-{{ $ikev2Status == 'Running' ? 'success' : 'danger' }}">{{ $ikev2Status == 'Running' ? 'Running' : $ikev2Status }}</span>
                </div>
                <div class="users-connected">
                    {{ $ikev2ConnectedUsers }} Users
                </div>
            </div>
        </div>
    </div>

    <div class="row layout-top-spacing">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 layout-spacing">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="card-title mb-0">Connected Users</h5>
                    <select class="form-select" wire:model.live="vpnTypeFilter">
                        <option value="all">All</option>
                        <option value="wireguard">WireGuard</option>
                        <option value="ikev2">IKEv2</option>
                    </select>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>IP</th>
                                    <th>Uptime</th>
                                    <th>VPN Type</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $filteredUsers = collect($connectedUsers)->filter(function ($user) use (
                                        $vpnTypeFilter,
                                    ) {
                                        return $vpnTypeFilter === 'all' || $user['vpn_type'] === $vpnTypeFilter;
                                    });
                                @endphp

                                @forelse ($filteredUsers as $index => $user)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ ucfirst(preg_replace('/_[^_]+$/', '', $user['name'])) }}</td>
                                        <td>{{ $user['ip'] }}</td>
                                        <td>{{ $user['uptime'] }}</td>
                                        <td>{{ ucfirst($user['vpn_type']) }}</td>
                                        <td>
                                            <a href="{{ route('user.manage', ['user' => strtolower(preg_replace('/_[^_]+$/', '', $user['name']))]) }}"
                                                class="btn btn-light-info btn-rounded btn-icon me-1 d-inline-flex align-items-center">
                                                <iconify-icon icon="ic:round-manage-accounts" width="20"
                                                    height="20"></iconify-icon>
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center">No connected users found</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
@script
    <script>
        setTimeout(() => {
            function extractNumber(value) {
                return parseFloat(value.replace(/[^\d.]/g, '')) || 0;
            }

            function createGaugeChart(element, value, label) {
                var options = {
                    series: [value],
                    chart: {
                        height: 250,
                        type: "radialBar",
                        offsetY: -10
                    },
                    plotOptions: {
                        radialBar: {
                            startAngle: -135,
                            endAngle: 135,
                            track: {
                                background: "#e0e0e0"
                            },
                            dataLabels: {
                                name: {
                                    fontSize: "16px",
                                    color: "#888",
                                    offsetY: 120
                                },
                                value: {
                                    offsetY: 76,
                                    fontSize: "22px",
                                    formatter: val => val + "%"
                                }
                            }
                        }
                    },
                    fill: {
                        type: "gradient",
                        gradient: {
                            stops: [0, 50, 65, 91]
                        }
                    },
                    stroke: {
                        dashArray: 4
                    },
                    labels: [label]
                };

                new ApexCharts(document.querySelector(element), options).render();
            }
            let cpuUsage = extractNumber(`{{ $cpuUsage }}`);
            let [ramUsed, ramTotal] = (`{{ $ramUsage }}`.match(/\d+/g) || [0, 1]).map(Number);
            let ramPercent = (ramUsed / ramTotal) * 100;
            let [diskUsed, diskTotal] = (`{{ $diskUsage }}`.match(/([\d.]+)/g) || [0, 1]).map(
                Number);
            let diskPercent = (diskUsed / diskTotal) * 100;

            createGaugeChart("#cpu-chart", cpuUsage, "CPU Usage");
            createGaugeChart("#ram-chart", ramPercent.toFixed(2), "RAM Usage");
            createGaugeChart("#disk-chart", diskPercent.toFixed(2), "Disk Usage");
        }, 2000);

        $wire.on('sweetToast', (event) => {
            Swal.fire({
                title: event.title,
                text: event.message,
                icon: event.type,
                timer: 3000,
                toast: true,
                position: 'bottom-end',
                showConfirmButton: false
            });
        });
    </script>
@endscript
