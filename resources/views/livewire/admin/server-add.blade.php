@section('title', 'Add Server')
@section('styles')
    <link href="{{ asset('src/assets/css/light/forms/switches.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('src/assets/css/dark/forms/switches.css') }}" rel="stylesheet" type="text/css" />

    <link href="{{ asset('src/plugins/src/notification/snackbar/snackbar.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('src/plugins/css/light/notification/snackbar/custom-snackbar.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('src/plugins/css/dark/notification/snackbar/custom-snackbar.css') }}" rel="stylesheet"
        type="text/css" />

    <link href="{{ asset('src/plugins/css/light/filepond/custom-filepond.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('src/plugins/css/dark/filepond/custom-filepond.css') }}" rel="stylesheet" type="text/css" />
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
                    <h5 class="card-title mb-0">Create Server</h5>
                </div>
                <div class="card-body">
                    @if ($errors->any())
                        @foreach ($errors->all() as $error)
                            <x-alert type="danger" :message="$error" />
                        @endforeach
                    @endif
                    <form class="row g-3" wire:submit.prevent="store">
                        <div class="col-sm-12">
                            <label for="name" class="form-label">Image</label>
                            <div class="multiple-file-upload">
                                <x-filepond::upload wire:model="image" allowImageValidateSize="true" maxFileSize="20MB"
                                    allowFileTypeValidation="true"
                                    acceptedFileTypes="image/jpeg, image/png, image/jpg" />
                            </div>
                        </div>
                        <div class="col-sm-12 mt-1">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" id="name" placeholder="Name" name="name"
                                wire:model="name">
                        </div>
                        <div class="col-sm-12">
                            <label for="type" class="form-label">Server Type</label>
                            <select class="form-select w-100" id="type" wire:model="type">
                                <option value="" selected>Select Type</option>
                                <option value="free">Free</option>
                                <option value="premium">Premium</option>
                            </select>
                        </div>
                        <div class="col-sm-12">
                            <label for="status" class="form-label">Status</label>
                            <select class="form-select w-100" id="status" wire:model="status">
                                <option value="" selected>Select Status</option>
                                <option value="active">Active</option>
                                <option value="inactive">Inactive</option>
                            </select>
                        </div>
                        <div class="col-sm-12">
                            <label for="longitude" class="form-label">Longitude</label>
                            <input type="text" class="form-control" id="name" placeholder="longitude" name="longitude"
                                wire:model="longitude">
                        </div>
                        <div class="col-sm-12">
                            <label for="latitude" class="form-label">Latitude</label>
                            <input type="text" class="form-control" id="name" placeholder="latitude" name="latitude"
                                wire:model="latitude">
                        </div>
                        <div class="col-sm-12">
                            <label class="form-label mb-2">Platforms</label>
                            <div class="form-check ps-0 mb-2">
                                <div class="switch form-switch-custom switch-inline form-switch-success">
                                    <input class="switch-input" type="checkbox" role="switch"
                                        id="form-custom-switch-success" wire:model="android">
                                    <label class="switch-label" for="form-custom-switch-success">Android</label>
                                </div>
                            </div>
                            <div class="form-check ps-0 mb-2">
                                <div class="switch form-switch-custom switch-inline form-switch-success">
                                    <input class="switch-input" type="checkbox" role="switch"
                                        id="form-custom-switch-success" wire:model="ios">
                                    <label class="switch-label" for="form-custom-switch-success">IOS</label>
                                </div>
                            </div>
                            <div class="form-check ps-0 mb-2">
                                <div class="switch form-switch-custom switch-inline form-switch-success">
                                    <input class="switch-input" type="checkbox" role="switch"
                                        id="form-custom-switch-success" wire:model="windows">
                                    <label class="switch-label" for="form-custom-switch-success">Windows</label>
                                </div>
                            </div>
                            <div class="form-check ps-0 mb-2">
                                <div class="switch form-switch-custom switch-inline form-switch-success">
                                    <input class="switch-input" type="checkbox" role="switch"
                                        id="form-custom-switch-success" wire:model="macos">
                                    <label class="switch-label" for="form-custom-switch-success">MacOS</label>
                                </div>
                            </div>
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
@section('scripts')
    <script src="{{ asset('src/plugins/src/notification/snackbar/snackbar.min.js') }}"></script>

    @filepondScripts
@endsection
