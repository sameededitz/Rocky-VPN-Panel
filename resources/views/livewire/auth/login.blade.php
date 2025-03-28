@section('title', 'Login')
<div class="row">
    <div class="col-xxl-4 col-xl-5 col-lg-5 col-md-8 col-12 d-flex flex-column align-self-center mx-auto">
        <div class="d-flex justify-content-center">
            <a href="{{ route('home') }}" wire:ignore class="text-decoration-none d-flex align-items-center gap-2">
                <img src="{{ asset('src/assets/img/logo.svg') }}" width="80px" class="navbar-logo" alt="logo">
                <h2 class="text-info">{{ config('app.name') }}</h2>
            </a>
        </div>
        <div class="card mt-3 mb-3">
            <div class="card-body">

                <form wire:submit="login">
                    <div class="row">
                        @if ($errors->any())
                            <div class="py-2">
                                @foreach ($errors->all() as $error)
                                    <x-alert type="danger" :message="$error" />
                                @endforeach
                            </div>
                        @endif

                        <div class="col-md-12 mb-3">

                            <h2>Sign In</h2>
                            <p>Enter your email and password to login</p>

                        </div>
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label class="form-label">Name</label>
                                <input type="text" class="form-control" wire:model="name" name="name" required>
                            </div>
                        </div>
                        <div class="col-12" x-data="{ showPassword: false }">
                            <label class="form-label" for="password">Password</label>
                            <div class="input-group mb-3">
                                <input :type="showPassword ? 'text' : 'password'" class="form-control" id="password"
                                    wire:model="password" name="password" required>
                                <span class="input-group-text">
                                    <button type="button" @click="showPassword = !showPassword"
                                        class="toggle-password text-decoration-none text-muted d-flex border-0 outline-0 p-0 bg-transparent">
                                        <iconify-icon :icon="showPassword ? 'mdi:eye' : 'mdi:eye-off'" width="24"
                                            height="24"></iconify-icon>
                                    </button>
                                </span>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="mb-3">
                                <div class="form-check form-check-primary form-check-inline">
                                    <input class="form-check-input me-3" type="checkbox" wire:model="remember"
                                        id="form-check-default">
                                    <label class="form-check-label" for="form-check-default">
                                        Remember me
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="mb-4">
                                <button class="btn btn-secondary w-100">Sign In</button>
                            </div>
                        </div>

                    </div>
                </form>

            </div>
        </div>
    </div>
</div>
