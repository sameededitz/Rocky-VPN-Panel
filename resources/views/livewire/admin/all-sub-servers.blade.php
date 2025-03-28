@section('title', 'All Sub Servers')

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
                    <li class="breadcrumb-item">
                        <a href="{{ route('servers') }}" class="d-flex align-items-center">
                            Servers
                        </a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Sub Servers</li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- BREADCRUMB -->

    <div class="row layout-top-spacing">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 layout-spacing">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="card-title mb-0">All Sub Servers</h5>
                    <a href="{{ route('sub-server.create', $server->id) }}"
                        class="btn btn-outline-info _effect--ripple waves-effect waves-light">
                        Create Sub Server
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
                                    <th>Name</th>
                                    <th>Status</th>
                                    <th>Created At</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($subServers as $subServer)
                                    <tr>
                                        <td>{{ $subServer->id }}</td>
                                        <td>{{ $subServer->name }}</td>
                                        <td>
                                            <span
                                                class="badge {{ $subServer->isActive() ? 'badge-light-success' : 'badge-light-danger' }}">
                                                {{ ucfirst($subServer->status) }}
                                            </span>
                                        </td>
                                        <td>{{ $subServer->created_at->toFormattedDateString() }}</td>
                                        <td>
                                            <div class="d-flex align-items-center justify-content-start">
                                                <a href="{{ route('sub-sub-servers', $subServer->id) }}"
                                                    class="btn btn-light-info btn-rounded btn-icon me-1 d-inline-flex align-items-center">
                                                    <Iconify-icon icon="solar:server-path-broken" width="20"
                                                        height="20"></Iconify-icon>
                                                </a>
                                                <a href="{{ route('sub-server.edit', ['server' => $server, 'subServer' => $subServer]) }}"
                                                    class="btn btn-light-success btn-rounded btn-icon me-1 d-inline-flex align-items-center">
                                                    <Iconify-icon icon="lucide:edit" width="20"
                                                        height="20"></Iconify-icon>
                                                </a>
                                                <button
                                                    class="btn btn-light-danger btn-rounded btn-icon d-inline-flex align-items-center"
                                                    wire:click="$js.confirmDelete({{ $subServer->id }})">
                                                    <Iconify-icon icon="mingcute:delete-2-line" width="20"
                                                        height="20"></Iconify-icon>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center">No Sub Servers found</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- 🌟 Pagination -->
                    <div class="mt-2">
                        {{ $subServers->links('components.pagination', data: ['scrollTo' => false]) }}
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
                    $wire.deleteSubServer(id);
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
