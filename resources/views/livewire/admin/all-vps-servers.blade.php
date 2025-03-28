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
                    <li class="breadcrumb-item active" aria-current="page">Users</li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- BREADCRUMB -->

    <div class="row layout-top-spacing">

        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 layout-spacing">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="card-title mb-0">All Users</h5>
                    <a href="{{ route('vps-server.create') }}"
                        class="btn btn-outline-info _effect--ripple waves-effect waves-light">
                        Add VPS Server
                    </a>
                </div>
                <div class="card-body">
                    <div class="d-flex justify-content-between mb-3">
                        <div class="d-flex align-items-center gap-3">
                            <select class="form-select" wire:model.live="perPage">
                                <option value="5">5</option>
                                <option value="10">10</option>
                                <option value="15">15</option>
                                <option value="20">20</option>
                                <option value="25">25</option>
                                <option value="50">50</option>
                            </select>
                            <select class="form-select" wire:model.live="statusFilter">
                                <option value="">Status</option>
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
                                    <th>IP Address</th>
                                    <th>Username</th>
                                    <th>Port</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($vpsServers as $server)
                                    <tr>
                                        <td>{{ $server->id }}</td>
                                        <td>{{ $server->name }}</td>
                                        <td>{{ $server->ip_address }}</td>
                                        <td>{{ $server->username }}</td>
                                        <td>{{ $server->port }}</td>
                                        <td>
                                            <span
                                                class="badge {{ $server->status === 'active' ? 'badge-light-success' : 'badge-light-danger' }}">{{ Str::title($server->status) }}</span>
                                        </td>
                                        <td>
                                            <div class="d-flex align-items-center justify-content-center">
                                                <a href="{{ route('vps-server.manage', $server->id) }}"
                                                    class="btn btn-light-info btn-rounded btn-icon me-1 d-inline-flex align-items-center">
                                                    <Iconify-icon icon="famicons:stats-chart-outline" width="20"
                                                        height="20"></Iconify-icon>
                                                </a>
                                                <button wire:click="$js.confirmEdit({{ $server->id }})"
                                                    class="btn btn-light-success btn-rounded btn-icon me-1 d-inline-flex align-items-center">
                                                    <Iconify-icon icon="lucide:edit" width="20"
                                                        height="20"></Iconify-icon>
                                                </button>
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
                                        <td colspan="7" class="text-center">No VPS servers found</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- 🌟 Pagination -->
                    <div class="mt-2">
                        {{ $vpsServers->links('components.pagination', data: ['scrollTo' => false]) }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="editServerModal" wire:ignore.self tabindex="-1" role="dialog"
        aria-labelledby="inputFormModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">

                <div class="modal-header" id="inputFormModalLabel">
                    <h5 class="modal-title">Edit <b>{{ $name }}</b></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true">
                        <Iconify-icon icon="bi:x-lg" width="20" height="20"></Iconify-icon>
                    </button>
                </div>
                <form class="mt-0" wire:submit.prevent="updateVpsServer">
                    <div class="modal-body">
                        <div class="alert alert-warning" role="alert">
                            <strong>Warning!</strong> You are about to edit a VPS server. Please make sure you know what
                            you are doing.
                        </div>
                        @if ($errors->any())
                            <div class="alert alert-danger" role="alert">
                                <strong>Whoops!</strong> Something went wrong!
                            </div>
                        @endif
                        <div class="form-group mb-3">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" id="name" placeholder="Name"
                                wire:model="name">
                            @error('name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label for="ip_address">IP Address</label>
                            <input type="text" class="form-control" id="ip_address" placeholder="IP Address"
                                wire:model="ip_address">
                            @error('ip_address')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label for="username">Username</label>
                            <input type="text" class="form-control" id="username" placeholder="Username"
                                wire:model="username">
                            @error('username')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label for="port">Port</label>
                            <input type="number" class="form-control" id="port" placeholder="Port"
                                wire:model="port">
                            @error('port')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label for="status">Status</label>
                            <select class="form-select w-100" id="status" wire:model="status">
                                <option value="active">Active</option>
                                <option value="inactive">Inactive</option>
                            </select>
                            @error('status')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label for="password">Password</label>
                            <input type="text" class="form-control" id="password" placeholder="Password"
                                wire:model="password">
                            @error('password')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label for="confirm_password">Private Key</label>
                            <textarea class="form-control" id="private_key" placeholder="Private Key" wire:model="private_key"></textarea>
                            @error('private_key')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-light-danger mt-2 mb-2 btn-no-effect"
                            data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary mt-2 mb-2 btn-no-effect">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@script
    <script>
        $js('confirmEdit', (id) => {
            let modalElement = document.getElementById('editServerModal');
            if (!modalElement) {
                console.error("Modal element not found");
                return;
            }
            let myModal = bootstrap.Modal.getInstance(modalElement);

            if (!myModal) {
                myModal = new bootstrap.Modal(modalElement);
            }
            myModal.show();
            $wire.editVpsServer(id);
        });

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
                    $wire.deleteVpsServer(id);
                }
            });
        });

        $wire.on('closeEditModal', () => {
            let modalElement = document.getElementById('editServerModal');
            let myModal = bootstrap.Modal.getInstance(modalElement);

            if (!myModal) {
                myModal = new bootstrap.Modal(modalElement);
            }
            myModal.hide();
            $wire.dispatch('sweetAlert', {
                title: 'Success!',
                message: 'VPS server updated successfully',
                type: 'success'
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
@section('title', 'All VPS Servers')
@section('styles')
    <link href="{{ asset('src/assets/css/light/elements/custom-pagination.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('src/assets/css/dark/elements/custom-pagination.css') }}" rel="stylesheet" type="text/css" />

    <link href="{{ asset('src/plugins/src/sweetalerts2/sweetalerts2.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('src/plugins/css/light/sweetalerts2/custom-sweetalert.css') }}" rel="stylesheet"
        type="text/css" />

    <link href="{{ asset('src/assets/css/light/components/modal.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('src/assets/css/dark/components/modal.css') }}" rel="stylesheet" type="text/css" />
@endsection
