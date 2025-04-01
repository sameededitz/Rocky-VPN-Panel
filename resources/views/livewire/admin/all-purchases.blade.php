@section('title', 'All Purchases')

@section('styles')
    <link href="{{ asset('src/assets/css/light/elements/custom-pagination.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('src/assets/css/dark/elements/custom-pagination.css') }}" rel="stylesheet" type="text/css" />

    <link href="{{ asset('src/plugins/src/sweetalerts2/sweetalerts2.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('src/plugins/css/light/sweetalerts2/custom-sweetalert.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('src/plugins/css/dark/sweetalerts2/custom-sweetalert.css') }}" rel="stylesheet" type="text/css" />
@endsection
<div>
    <div class="page-meta">
        <div class="breadcrumb-wrapper-content d-flex justify-content-end">
            <nav class="breadcrumb-style-three">
                <ol class="breadcrumb align-items-center">
                    <li class="breadcrumb-item">
                        <a href="{{ route('dashboard') }}">
                            <iconify-icon icon="stash:home-duotone" width="24" height="24"></iconify-icon>
                        </a>
                    </li>
                    <li class="breadcrumb-item active">Purchases</li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="row layout-top-spacing">
        <div class="col-12 layout-spacing">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="card-title mb-0">All Purchases</h5>
                </div>
                <div class="card-body">
                    <div class="d-flex justify-content-between mb-3 flex-wrap row-gap-3">
                        <div class="d-flex align-items-center gap-3 flex-wrap">
                            <select class="form-select form-select-sm" wire:model.live="perPage">
                                <option value="5">5</option>
                                <option value="10">10</option>
                                <option value="15">15</option>
                                <option value="20">20</option>
                                <option value="25">25</option>
                                <option value="50">50</option>
                            </select>
                            <select class="form-select form-select-sm" wire:model.live="amountFilter">
                                <option value="" selected>Max Amount</option>
                                <option value="10">Under $10</option>
                                <option value="20">Under $20</option>
                                <option value="50">Under $50</option>
                                <option value="100">Under $100</option>
                            </select>
                            <select class="form-select form-select-sm" wire:model.live="statusFilter">
                                <option value="" selected>Status</option>
                                <option value="active">Active</option>
                                <option value="expired">Expired</option>
                                <option value="cancelled">Cancelled</option>
                            </select>
                        </div>
                        <div class="search-input">
                            <div class="input-group input-group-sm">
                                <input type="text" class="form-control" placeholder="Search..."
                                    wire:model.live.500ms="search">
                                <span class="input-group-text">
                                    <iconify-icon icon="material-symbols-light:search" width="20"
                                        height="20"></iconify-icon>
                                </span>
                            </div>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>User</th>
                                    <th>Plan</th>
                                    <th>Amount Paid</th>
                                    <th>Start Date</th>
                                    <th>End Date</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($purchases as $purchase)
                                    <tr>
                                        <td>{{ $purchase->id }}</td>
                                        <td>
                                            <a href="{{ route('user.manage', $purchase->user->slug) }}"
                                                class="text-primary">
                                                {{ Str::title($purchase->user->name) ?? 'N/A' }}
                                            </a>
                                        </td>
                                        <td>{{ $purchase->plan->name ?? 'N/A' }}</td>
                                        <td>${{ number_format($purchase->amount_paid, 2) }}</td>
                                        <td>{{ $purchase->start_date->toFormattedDateString() }}</td>
                                        <td>{{ optional($purchase->end_date)->toFormattedDateString() ?? 'N/A' }}</td>
                                        <td>
                                            <span
                                                class="badge bg-light-{{ $purchase->status == 'active' ? 'success' : ($purchase->status == 'expired' ? 'danger' : 'warning') }}">
                                                {{ ucfirst($purchase->status) }}
                                            </span>
                                        </td>
                                        <td>
                                            <div class="d-flex align-items-center gap-1">
                                                @if ($purchase->status != 'active')
                                                    @if (($purchase->status == 'expired' || $purchase->status == 'cancelled') && \Carbon\Carbon::parse($purchase->end_date)->isFuture())
                                                        <button
                                                            class="btn btn-light-success btn-rounded btn-icon d-inline-flex align-items-center"
                                                            wire:click="$js.updateStatus({{ $purchase->id }}, 'active')"
                                                            @disabled($purchase->status == 'active')>
                                                            <iconify-icon icon="material-symbols:check-circle"
                                                                width="20" height="20"></iconify-icon>
                                                        </button>
                                                    @endif
                                                @else
                                                    <button
                                                        class="btn btn-light-warning btn-rounded btn-icon d-inline-flex align-items-center"
                                                        wire:click="$js.updateStatus({{ $purchase->id }}, 'expired')"
                                                        @disabled($purchase->status == 'expired')>
                                                        <iconify-icon icon="mdi:clock-alert" width="20"
                                                            height="20"></iconify-icon>
                                                    </button>

                                                    <button
                                                        class="btn btn-light-danger btn-rounded btn-icon d-inline-flex align-items-center"
                                                        wire:click="$js.updateStatus({{ $purchase->id }}, 'cancelled')"
                                                        @disabled($purchase->status == 'cancelled')>
                                                        <iconify-icon icon="mdi:close-circle" width="20"
                                                            height="20"></iconify-icon>
                                                    </button>
                                                @endif
                                                <button
                                                    class="btn btn-light-danger btn-rounded btn-icon d-inline-flex align-items-center"
                                                    wire:click="$js.confirmDelete({{ $purchase->id }})">
                                                    <iconify-icon icon="mingcute:delete-2-line" width="20"
                                                        height="20"></iconify-icon>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="8" class="text-center">No purchases found</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-2">
                        {{ $purchases->links('components.pagination', data: ['scrollTo' => false]) }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@script
    <script>
        $js('confirmDelete', (id) => {
            Swal.fire({
                title: 'Are you sure?',
                text: 'You won\'t be able to revert this!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $wire.deletePlan(id);
                }
            });
        });

        $js('updateStatus', (id, status) => {
            let actionText = status === 'active' ? 'activate' : (status === 'expired' ? 'expire' : 'cancel');
            let actionBtnText = status === 'active' ? 'Yes, activate it!' : (status === 'expired' ?
                'Yes, expire it!' : 'Yes, cancel it!');

            Swal.fire({
                title: `Are you sure you want to ${actionText} this purchase?`,
                text: 'You won\'t be able to revert this!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: actionBtnText
            }).then((result) => {
                if (result.isConfirmed) {
                    $wire.updateStatus(id, status);
                }
            });
        });

        $wire.on('sweetAlert', (event) => {
            Swal.fire({
                title: event.title,
                text: event.message,
                icon: event.type,
                timer: 2000,
                showConfirmButton: false
            });
        });
    </script>
@endscript
