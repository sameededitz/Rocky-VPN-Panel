@section('title', 'All Feedback')

@section('styles')
    <link href="{{ asset('src/assets/css/light/elements/custom-pagination.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('src/assets/css/dark/elements/custom-pagination.css') }}" rel="stylesheet" type="text/css" />

    <link href="{{ asset('src/plugins/src/sweetalerts2/sweetalerts2.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('src/plugins/css/light/sweetalerts2/custom-sweetalert.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('src/plugins/css/dark/sweetalerts2/custom-sweetalert.css') }}" rel="stylesheet" type="text/css" />

    <link href="{{ asset('src/assets/css/light/components/modal.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('src/assets/css/dark/components/modal.css') }}" rel="stylesheet" type="text/css" />
@endsection
<div>
    <div class="page-meta">
        <div class="breadcrumb-wrapper-content d-flex justify-content-end">
            <nav class="breadcrumb-style-three">
                <ol class="breadcrumb align-items-center">
                    <li class="breadcrumb-item">
                        <a href="{{ route('dashboard') }}">
                            <iconify-icon icon="stash:home-duotone" width="24" height="24"></iconify-icon>
                        </a>
                    </li>
                    <li class="breadcrumb-item">Settings</li>
                    <li class="breadcrumb-item active">Mail</li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="row layout-top-spacing">
        <div class="col-xl-6 col-lg-8 col-md-12 col-sm-12 mb-3">
            <div class="card">
                <div class="card-body">
                    <h4 class="mb-2">Mail Settings</h4>
                    <p class="text-muted mb-4">Configure your mail settings below:</p>
                    @if ($errors->any())
                        @foreach ($errors->all() as $error)
                            <x-alert type="danger" :message="$error" />
                        @endforeach
                    @endif
                    <form class="row g-3" wire:submit.prevent="store">
                        <div class="col-sm-12">
                            <label for="mail_driver" class="form-label">Mail Driver</label>
                            <input type="text" class="form-control" id="mail_driver" placeholder="Mail Driver"
                                name="mail_driver" wire:model="mail_driver">
                        </div>
                        <div class="col-sm-12">
                            <label for="mail_host" class="form-label">Mail Host</label>
                            <input type="text" class="form-control" id="mail_host" placeholder="Mail Host"
                                name="mail_host" wire:model="mail_host">
                        </div>
                        <div class="col-sm-12">
                            <label for="mail_port" class="form-label">Mail Port</label>
                            <input type="text" class="form-control" id="mail_port" placeholder="Mail Port"
                                name="mail_port" wire:model="mail_port">
                        </div>
                        <div class="col-sm-12">
                            <label for="mail_username" class="form-label">Mail Username</label>
                            <input type="text" class="form-control" id="mail_username" placeholder="Mail Username"
                                name="mail_username" wire:model="mail_username">
                        </div>
                        <div class="col-sm-12">
                            <label for="mail_password" class="form-label">Mail Password</label>
                            <input type="text" class="form-control" id="mail_password" placeholder="Mail Password"
                                name="mail_password" wire:model="mail_password">
                        </div>
                        <div class="col-sm-12">
                            <label for="mail_from_address" class="form-label">Mail From Address</label>
                            <input type="text" class="form-control" id="mail_from_address" placeholder="Mail From Address"
                                name="mail_from_address" wire:model="mail_from_address">
                        </div>
                        <div class="col-sm-12">
                            <label for="mail_from_name" class="form-label">Mail From Name</label>
                            <input type="text" class="form-control" id="mail_from_name" placeholder="Mail From Name"
                                name="mail_from_name" wire:model="mail_from_name">
                        </div>
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@script
    <script>
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
