@section('title', 'All Servers')

@section('styles')
    <link href="{{ asset('src/assets/css/light/elements/custom-pagination.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('src/assets/css/dark/elements/custom-pagination.css') }}" rel="stylesheet" type="text/css" />

    <link href="{{ asset('src/plugins/src/sweetalerts2/sweetalerts2.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('src/plugins/css/light/sweetalerts2/custom-sweetalert.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('src/plugins/css/dark/sweetalerts2/custom-sweetalert.css') }}" rel="stylesheet" type="text/css" />
@endsection
<div>
    <!-- BREADCRUMB -->
    <div class="page-meta">
        <div class="breadcrumb-wrapper-content d-flex justify-content-end">
            <nav class="breadcrumb-style-three" aria-label="breadcrumb">
                <ol class="breadcrumb align-items-center">
                    <li class="breadcrumb-item">
                        <a href="{{ route('dashboard') }}" class="d-flex align-items-center">
                            <iconify-icon icon="stash:home-duotone" class="mb-1" width="24"
                                height="24"></iconify-icon>
                        </a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Servers</li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- BREADCRUMB -->

    <div class="row layout-top-spacing">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 layout-spacing">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="card-title mb-0">All Servers</h5>
                    <a href="{{ route('server.create') }}"
                        class="btn btn-outline-info _effect--ripple waves-effect waves-light">
                        Create Server
                    </a>
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
                            <select class="form-select form-select-sm" wire:model.live="statusFilter">
                                <option value="" selected>Status</option>
                                <option value="active">Active</option>
                                <option value="inactive">Inactive</option>
                            </select>
                            <select class="form-select form-select-sm" wire:model.live="typeFilter">
                                <option value="" selected>Type</option>
                                <option value="free">Free</option>
                                <option value="premium">Premium</option>
                            </select>
                            <select class="form-select form-select-sm" wire:model.live="platformFilter">
                                <option value="" selected>Platform</option>
                                <option value="windows">Windows</option>
                                <option value="macos">Mac</option>
                                <option value="ios">iOS</option>
                                <option value="android">Android</option>
                            </select>
                        </div>
                        <div class="seach-input">
                            <div class="input-group input-group-sm">
                                <input type="text" class="form-control" placeholder="Search..."
                                    wire:model.live.500ms="search">
                                <span class="input-group-text" id="basic-addon1">
                                    <Iconify-icon icon="material-symbols-light:search" width="20"
                                        height="20"></Iconify-icon>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Image</th>
                                    <th>Name</th>
                                    <th>Platforms</th>
                                    <th>Type</th>
                                    <th>Status</th>
                                    <th>Created At</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($servers as $server)
                                    <tr>
                                        <td>{{ $server->id }}</td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <img src="{{ $server->getFirstMediaUrl('image') }}"
                                                    alt="{{ $server->name }}" width="70px" style="border-radius: 4px">
                                            </div>
                                        </td>
                                        <td>{{ $server->name }}</td>
                                        <td>
                                            <span
                                                class="badge badge-light-primary">{{ $server->android ? 'Android' : '' }}</span>
                                            <span
                                                class="badge badge-light-secondary">{{ $server->ios ? 'iOS' : '' }}</span>
                                            <span
                                                class="badge badge-light-warning">{{ $server->macos ? 'MacOS' : '' }}</span>
                                            <span
                                                class="badge badge-light-success">{{ $server->windows ? 'Windows' : '' }}</span>
                                        </td>
                                        <td>
                                            <span
                                                class="badge {{ $server->isPremium() ? 'badge-light-primary' : 'badge-light-info' }}">
                                                {{ ucfirst($server->type) }}
                                            </span>
                                        </td>
                                        <td>
                                            <span
                                                class="badge {{ $server->isActive() ? 'badge-light-success' : 'badge-light-danger' }}">
                                                {{ ucfirst($server->status) }}
                                            </span>
                                        </td>
                                        <td>{{ $server->created_at->toFormattedDateString() }}</td>
                                        <td>
                                            <div class="d-flex align-items-center justify-content-center">
                                                <a href="{{ route('sub-servers', $server->id) }}"
                                                    class="btn btn-light-info btn-rounded btn-icon me-1 d-inline-flex align-items-center">
                                                    <Iconify-icon icon="solar:server-square-broken" width="20"
                                                        height="20"></Iconify-icon>
                                                </a>
                                                <a href="{{ route('server.edit', $server->id) }}"
                                                    class="btn btn-light-success btn-rounded btn-icon me-1 d-inline-flex align-items-center">
                                                    <Iconify-icon icon="lucide:edit" width="20"
                                                        height="20"></Iconify-icon>
                                                </a>
                                                <button
                                                    class="btn btn-light-danger btn-rounded btn-icon d-inline-flex align-items-center"
                                                    wire:click="$js.confirmDelete({{ $server->id }})">
                                                    <Iconify-icon icon="mingcute:delete-2-line" width="20"
                                                        height="20"></Iconify-icon>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center">No Servers found</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- 🌟 Pagination -->
                    <div class="mt-2">
                        {{ $servers->links('components.pagination', data: ['scrollTo' => false]) }}
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
                    $wire.deleteServer(id);
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
