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
                    <li class="breadcrumb-item active" aria-current="page">{{ Str::limit($user->name, 10, '...') }}</li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- BREADCRUMB -->

    <div class="row layout-top-spacing">

        <div class="col-xl-6 col-lg-12 col-md-12 col-sm-12 mb-3 order-1 order-md-2">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Personal Info</h5>
                </div>
                <div class="card-body">
                    <div class="mt-16">
                        <ul class="ps-0 fs-6">
                            <li class="d-flex align-items-center gap-1 mb-12">
                                <p class="w-30 fw-semibold text-primary-light">Full Name</p>
                                <p class="w-70 fw-medium">: {{ $user->name }} </p>
                            </li>
                            <li class="d-flex align-items-center gap-1 mb-12">
                                <p class="w-30 text-md fw-semibold text-primary-light"> Email</p>
                                <p class="w-70 text-secondary-light fw-medium">: {{ $user->email }} </p>
                            </li>
                            <li class="d-flex align-items-center gap-1 mb-12">
                                <p class="w-30 text-md fw-semibold text-primary-light"> Role</p>
                                <p class="w-70 text-secondary-light fw-medium">: {{ Str::title($user->role) }}
                                </p>
                            </li>
                            <li class="d-flex align-items-center gap-1 mb-12">
                                <p class="w-30 text-md fw-semibold text-primary-light"> Last Login</p>
                                <p class="w-70 text-secondary-light fw-medium">:
                                    {{ $user->last_login ? $user->last_login->diffForHumans() : 'Never' }} </p>
                            </li>
                            <li class="d-flex align-items-center gap-1 mb-12">
                                <p class="w-30 text-md fw-semibold text-primary-light mb-0"> Registered</p>
                                <p class="w-70 text-secondary-light fw-medium mb-0">:
                                    {{ $user->created_at->toDayDateTimeString() }}</p>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        @if ($user->role == 'user')
            <div class="col-xl-6 col-lg-12 col-md-12 col-sm-12 mb-3 order-2 order-md-1">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Manage Purchases</h5>
                    </div>
                    <div class="card-body">
                        <h5>Active Plan</h5>
                        <ul class="ps-0 fs-6 border-bottom pb-2">
                            @if ($user->activePlan)
                                <li class="d-flex align-items-center gap-1 mb-12">
                                    <p class="w-30 fw-semibold text-primary-light">Plan</p>
                                    <p class="w-70 fw-medium">: {{ $user->activePlan->plan->name }} </p>
                                </li>
                                <li class="d-flex align-items-center gap-1 mb-12">
                                    <p class="w-30 text-md fw-semibold text-primary-light"> Expires At </p>
                                    <p class="w-70 text-secondary-light fw-medium">:
                                        {{ $user->activePlan->end_date->toDayDateTimeString() }} </p>
                                </li>
                                <button class="btn btn-outline-info mb-2 _effect--ripple waves-effect waves-light"
                                    wire:click="cancelPurchase">
                                    Cancel Plan
                                </button>
                            @else
                                <li class="d-flex align-items-center gap-1 mb-12">
                                    <p class="w-20 text-md fw-semibold text-primary-light">Plan</p>
                                    <p class="w-80 text-secondary-light fw-medium">: No Active Plan </p>
                                </li>
                            @endif
                        </ul>
                        <h6>Add or Extend Plan</h6>
                        <div class="form-group mb-3">
                            <select class="form-select" id="exampleFormControlSelect1" wire:model="selectedPlan">
                                <option value="" selected>Select Plan</option>
                                @foreach ($plans as $plan)
                                    <option value="{{ $plan->id }}">{{ $plan->name }}
                                        ({{ $plan->duration }}
                                        {{ Str::plural($plan->duration_unit, $plan->duration) }})
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <button class="btn btn-outline-info _effect--ripple waves-effect waves-light"
                            wire:click="addPlan">
                            @if ($user->activePlan)
                                Extend Plan
                            @else
                                Add Plan
                            @endif
                        </button>
                    </div>
                </div>
            </div>
            <div class="col-xl-6 col-lg-12 col-md-12 col-sm-12 order-3 order-md-3">
                <div class="payment-history layout-spacing ">
                    <div class="widget-content widget-content-area">
                        <h3 class="">Payment History</h3>
                        <div class="list-group">
                            @forelse ($user->purchases->sortByDesc('created_at') as $purchase)
                                <div class="list-group-item d-flex justify-content-between align-items-start">
                                    <div class="me-auto">
                                        <div class="fw-bold title">{{ $purchase->plan->name }}</div>
                                        <p class="sub-title mb-0">({{ $purchase->start_date->toFormattedDateString() }}
                                            -
                                            {{ $purchase->end_date->toFormattedDateString() }})
                                            - {{ Str::title($purchase->status) }}</p>
                                    </div>
                                    <span
                                        class="pay-pricing align-self-center me-3">${{ $purchase->amount_paid }}</span>
                                </div>
                            @empty
                                <div class="list-group-item">
                                    <p class="mb-0">No purchase history available.</p>
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>
@script
    <script>
        $wire.on('snackbar', (event) => {
            showSnackbar(event.message, event.type);
        });
    </script>
@endscript
@section('title', 'Manage User')
@section('styles')
    <link href="{{ asset('src/assets/css/light/components/list-group.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('src/assets/css/dark/components/list-group.css') }}" rel="stylesheet" type="text/css" />

    <link href="{{ asset('src/assets/css/light/users/user-profile.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('src/assets/css/dark/users/user-profile.css') }}" rel="stylesheet" type="text/css" />

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
