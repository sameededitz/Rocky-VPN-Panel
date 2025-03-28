@section('title', 'Edit Plan')

@section('styles')
    <link href="{{ asset('src/plugins/src/notification/snackbar/snackbar.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('src/plugins/css/light/notification/snackbar/custom-snackbar.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('src/plugins/css/dark/notification/snackbar/custom-snackbar.css') }}" rel="stylesheet"
        type="text/css" />
@endsection

<div>
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
                        <a href="{{ route('plans') }}" class="d-flex align-items-center">Plans</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Edit</li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="row layout-top-spacing">
        <div class="col-xl-6 col-lg-8 col-md-12 col-sm-12 mb-3">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Edit Plan</h5>
                </div>
                <div class="card-body">
                    @if ($errors->any())
                        @foreach ($errors->all() as $error)
                            <x-alert type="danger" :message="$error" />
                        @endforeach
                    @endif

                    <form class="row g-3" wire:submit.prevent="update">
                        <div class="col-sm-12">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" id="name" wire:model="name">
                        </div>
                        <div class="col-sm-12">
                            <label for="description" class="form-label">Description</label>
                            <input type="text" class="form-control" id="description" wire:model="description">
                        </div>
                        <div class="col-sm-12">
                            <label for="price" class="form-label">Price</label>
                            <input type="number" class="form-control" step="0.01" id="price" wire:model="price">
                        </div>
                        <div class="col-sm-12">
                            <div class="row g-2">
                                <div class="col-sm-6">
                                    <label for="duration" class="form-label">Duration</label>
                                    <input type="number" class="form-control" id="duration" wire:model="duration">
                                </div>
                                <div class="col-sm-6">
                                    <label for="duration_unit" class="form-label">Duration Unit</label>
                                    <select class="form-select w-100" id="duration_unit" wire:model="duration_unit" style="height: 48px">
                                        <option value="" selected>Select Unit</option>
                                        <option value="day">Day</option>
                                        <option value="week">Week</option>
                                        <option value="month">Month</option>
                                        <option value="year">Year</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="col-12">
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
