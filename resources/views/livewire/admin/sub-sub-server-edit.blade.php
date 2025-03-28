@section('title', 'Edit Sub-Sub Server')

@section('styles')
    <link href="{{ asset('src/plugins/src/notification/snackbar/snackbar.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('src/plugins/css/light/notification/snackbar/custom-snackbar.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('src/plugins/css/dark/notification/snackbar/custom-snackbar.css') }}" rel="stylesheet" type="text/css" />
@endsection

<div>
    <!-- Breadcrumb -->
    <div class="page-meta">
        <div class="breadcrumb-wrapper-content d-flex justify-content-end">
            <nav class="breadcrumb-style-three" aria-label="breadcrumb">
                <ol class="breadcrumb align-items-center">
                    <li class="breadcrumb-item">
                        <a href="{{ route('dashboard') }}" class="d-flex align-items-center">
                            <iconify-icon icon="stash:home-duotone" class="mb-1" width="24" height="24"></iconify-icon>
                        </a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{ route('sub-sub-servers', $subServer->id) }}" class="d-flex align-items-center">Sub Servers</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">
                        Edit
                    </li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- Breadcrumb -->

    <div class="row layout-top-spacing">
        <div class="col-xl-6 col-lg-8 col-md-10 col-sm-12 layout-spacing">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="card-title mb-0">Edit Sub-Sub Server</h5>
                </div>
                <div class="card-body">
                    <form wire:submit.prevent="update">
                        <div class="mb-3">
                            <label for="name" class="form-label">Sub-Sub Server Name</label>
                            <input type="text" id="name" class="form-control" wire:model.defer="name">
                            @error('name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="vps_server_id" class="form-label">Linked VPS Server</label>
                            <select id="vps_server_id" class="form-select w-100" wire:model.defer="vps_server">
                                <option value="" selected>Select a VPS Server</option>
                                @foreach ($vpsServers as $vpsServer)
                                    <option value="{{ $vpsServer->id }}">
                                        {{ $vpsServer->name ?? 'Unnamed VPS' }} ({{ $vpsServer->ip_address }}) -
                                        {{ Str::title($vpsServer->status) }}
                                    </option>
                                @endforeach
                            </select>
                            @error('vps_server_id')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="d-flex align-items-center gap-2">
                            <a href="{{ route('sub-sub-servers', $subServer->id) }}" class="btn btn-outline-secondary">Cancel</a>
                            <button type="submit" class="btn btn-primary">Update</button>
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
    <script src="{{ asset('src/assets/js/components/notification/custom-snackbar.js') }}"></script>
@endsection