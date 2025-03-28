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
                        <a href="{{ route('users') }}" class="d-flex align-items-center">
                            Users
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
                    @if ($errors->any())
                        @foreach ($errors->all() as $error)
                            <x-alert type="danger" :message="$error" />
                        @endforeach
                    @endif
                    <form class="row g-3" wire:submit.prevent="store">
                        <div class="col-sm-12">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" id="name" placeholder="Name" name="name"
                                wire:model="name">
                        </div>
                        <div class="col-sm-12">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" placeholder="Email address"
                                name="email" wire:model="email">
                        </div>
                        <div class="col-12" x-data="{ showPassword: false }">
                            <label class="form-label" for="password">Password</label>
                            <div class="input-group">
                                <input :type="showPassword ? 'text' : 'password'" class="form-control" id="password"
                                    wire:model="password" name="password" placeholder="Password">
                                <span class="input-group-text">
                                    <button type="button" @click="showPassword = !showPassword"
                                        class="toggle-password text-decoration-none text-muted d-flex border-0 outline-0 p-0 bg-transparent">
                                        <iconify-icon :icon="showPassword ? 'mdi:eye' : 'mdi:eye-off'" width="24"
                                            height="24"></iconify-icon>
                                    </button>
                                </span>
                            </div>
                        </div>
                        <div class="col-12" x-data="{ showConfirmPassword: false }">
                            <label for="inputConfirmPassword4" class="form-label">Confirm Password</label>
                            <div class="input-group">
                                <input :type="showConfirmPassword ? 'text' : 'password'" class="form-control"
                                    id="inputConfirmPassword1" placeholder="Confirm Password"
                                    name="password_confirmation" wire:model="password_confirmation">
                                <span class="input-group-text">
                                    <button type="button" @click="showConfirmPassword = !showConfirmPassword"
                                        class="toggle-password text-decoration-none text-muted d-flex border-0 outline-0 p-0 bg-transparent">
                                        <iconify-icon :icon="showConfirmPassword ? 'mdi:eye' : 'mdi:eye-off'"
                                            width="24" height="24"></iconify-icon>
                                    </button>
                                </span>
                            </div>
                        </div>
                        @if (request()->routeIs('admin.add'))
                            <div class="col-12">
                                <label for="inputConfirmPassword4" class="form-label">Role</label>
                                <select class="form-select" wire:model="role">
                                    <option value="user" selected>User</option>
                                    <option value="admin">Admin</option>
                                </select>
                            </div>
                        @else
                            <input type="hidden" wire:model="role" value="user">
                        @endif
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
