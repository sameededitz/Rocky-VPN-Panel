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
                        <a href="{{ route('vps-servers') }}" class="d-flex align-items-center">
                            VPS Servers
                        </a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Create</li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- BREADCRUMB -->

    <div class="row layout-top-spacing">

        <div class="col-xl-6 col-lg-8 col-md-12 col-sm-12 mb-3">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Create User</h5>
                </div>
                <div class="card-body">
                    <form class="row g-3" wire:submit.prevent="store">
                        @if ($errors->any())
                            <div class="alert alert-danger" role="alert">
                                <strong>Whoops!</strong> Something went wrong!
                            </div>
                        @endif
                        <div class="col-12">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" id="name" placeholder="Name"
                                wire:model="name">
                            @error('name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-12">
                            <label for="ip_address">IP Address</label>
                            <input type="text" class="form-control" id="ip_address" placeholder="IP Address"
                                wire:model="ip_address">
                            @error('ip_address')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-12">
                            <label for="username">Username</label>
                            <input type="text" class="form-control" id="username" placeholder="Username"
                                wire:model="username">
                            @error('username')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-12">
                            <label for="port">Port</label>
                            <input type="number" class="form-control" id="port" placeholder="Port"
                                wire:model="port">
                            @error('port')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-12">
                            <label for="status">Status</label>
                            <select class="form-select w-100" id="status" wire:model="status">
                                <option value="" selected>Select Status</option>
                                <option value="active">Active</option>
                                <option value="inactive">Inactive</option>
                            </select>
                            @error('status')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-12">
                            <label for="password">Password</label>
                            <input type="text" class="form-control" id="password" placeholder="Password"
                                wire:model="password">
                            @error('password')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-12">
                            <label for="confirm_password">Private Key</label>
                            <textarea class="form-control" id="private_key" placeholder="Private Key" wire:model="private_key"></textarea>
                            @error('private_key')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary">Create</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@script
    <script>
        $wire.on('snackbar', (event) => {
            showSnackbar(event.message, event.type);
        });
        $wire.on('redirect', (event) => {
            setTimeout(() => {
                window.location.href = event.url;
            }, 1000);
        });
    </script>
@endscript
@section('title', 'Manage User')
@section('styles')
    <link href="{{ asset('src/plugins/src/notification/snackbar/snackbar.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('src/plugins/css/light/notification/snackbar/custom-snackbar.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('src/plugins/css/dark/notification/snackbar/custom-snackbar.css') }}" rel="stylesheet"
        type="text/css" />
@endsection
@section('scripts')
    <script src="{{ asset('src/plugins/src/notification/snackbar/snackbar.min.js') }}"></script>
    <script src="{{ asset('src/assets/js/components/notification/custom-snackbar.js') }}"></script>
@endsection