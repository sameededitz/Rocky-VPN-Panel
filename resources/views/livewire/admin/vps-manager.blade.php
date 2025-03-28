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

        {{ json_encode($cpuUsage) }}
        {{ json_encode($ramUsage) }}
        {{ json_encode($diskUsage) }}

    </div>
</div>
@script
    <script>
        setTimeout(() => {
            let cpuUsage = {{ (float) preg_replace('/[^\d.]/', '', $cpuUsage) }} || 0;

            @php
                preg_match('/(\d+)\/(\d+)/', $ramUsage, $ramMatches);
                preg_match('/([\d.]+)G\s+\/\s+([\d.]+)G/', $diskUsage, $diskMatches);
            @endphp

            let ramUsage = {{ isset($ramMatches[1]) ? (int) $ramMatches[1] : 0 }};
            let ramTotal = {{ isset($ramMatches[2]) ? (int) $ramMatches[2] : 1 }};
            let ramPercent = (ramUsage / ramTotal) * 100;

            let diskUsage = {{ isset($diskMatches[1]) ? (float) $diskMatches[1] : 0 }};
            let diskTotal = {{ isset($diskMatches[2]) ? (float) $diskMatches[2] : 1 }};
            let diskPercent = (diskUsage / diskTotal) * 100;

            // console.log(ramUsage, ramTotal, ramPercent, diskUsage, diskTotal, diskPercent);

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
                                    color: undefined,
                                    formatter: function(val) {
                                        return val + "%";
                                    }
                                }
                            }
                        }
                    },
                    fill: {
                        type: "gradient",
                        gradient: {
                            shade: "dark",
                            shadeIntensity: 0.15,
                            inverseColors: false,
                            opacityFrom: 1,
                            opacityTo: 1,
                            stops: [0, 50, 65, 91]
                        }
                    },
                    stroke: {
                        dashArray: 4
                    },
                    labels: [label]
                };

                var chart = new ApexCharts(document.querySelector(element), options);
                chart.render();
            }

            createGaugeChart("#cpu-chart", cpuUsage, "CPU Usage");
            createGaugeChart("#ram-chart", ramPercent.toFixed(2), "RAM Usage");
            createGaugeChart("#disk-chart", diskUsage, "Disk Usage");
        }, 2000);
    </script>
@endscript
