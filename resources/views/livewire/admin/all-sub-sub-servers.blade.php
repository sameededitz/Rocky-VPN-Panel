@section('title', 'All Sub Sub Servers')

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
                        <a href="{{ route('sub-servers', $subServer->server_id) }}" class="d-flex align-items-center">
                            Sub Servers
                        </a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Sub Sub Servers</li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- BREADCRUMB -->

    <div class="row layout-top-spacing">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 layout-spacing">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="card-title mb-0">All Sub Sub Servers</h5>
                    <a href="{{ route('sub-sub-server.create', $subServer) }}"
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
                        </div>
                        <div class="search-input">
                            <div class="input-group input-group-sm">
                                <input type="text" class="form-control" placeholder="Search..."
                                    wire:model.live.500ms="search">
                                <span class="input-group-text" id="basic-addon1">
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
                                    <th>Name</th>
                                    <th>Linked VPS Server</th>
                                    <th>VPS Server Username</th>
                                    <th>VPS Server IP Address</th>
                                    <th>Created At</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($subSubServers as $subSubServer)
                                    <tr>
                                        <td>{{ $subSubServer->id }}</td>
                                        <td>{{ $subSubServer->name }}</td>
                                        <td>{{ $subSubServer->vpsServer->name ?? 'N/A' }}</td>
                                        <td>{{ $subSubServer->vpsServer->username }}</td>
                                        <td>{{ $subSubServer->vpsServer->ip_address }}</td>
                                        <td>{{ $subSubServer->created_at->toFormattedDateString() }}</td>
                                        <td>
                                            <div class="d-flex align-items-center justify-content-start">
                                                <a href="{{ route('sub-sub-server.edit', ['subServer' => $subServer->id, 'subSubServer' => $subSubServer->id]) }}"
                                                    class="btn btn-light-success btn-rounded btn-icon me-1 d-inline-flex align-items-center">
                                                    <Iconify-icon icon="lucide:edit" width="20"
                                                        height="20"></Iconify-icon>
                                                </a>
                                                <button
                                                    class="btn btn-light-danger btn-rounded btn-icon d-inline-flex align-items-center"
                                                    wire:click="$js.confirmDelete({{ $subSubServer->id }})">
                                                    <Iconify-icon icon="mingcute:delete-2-line" width="20"
                                                        height="20"></Iconify-icon>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center">No Sub Sub Servers found</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- 🌟 Pagination -->
                    <div class="mt-2">
                        {{ $subSubServers->links('components.pagination', data: ['scrollTo' => false]) }}
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
                    $wire.deleteSubSubServer(id);
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
