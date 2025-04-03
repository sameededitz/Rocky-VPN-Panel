@section('title', 'Reset Password')
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
                <form wire:submit.prevent="resetPassword">
                    <input type="hidden" wire:model="token">
                    <input type="hidden" wire:model="email">
                    <div class="row">
                        <div class="col-md-12 mb-3 text-center">

                            <h2>Reset Password</h2>
                            <p>Enter your new password</p>

                        </div>

                        @if (!$errors->has('password'))
                            <div class="py-2">
                                @foreach ($errors->all() as $error)
                                    <x-alert type="danger" :message="$error" />
                                @endforeach
                            </div>
                        @endif

                        <div class="col-12 mb-3" x-data="{ showPassword: false }">
                            <label class="form-label" for="password">Password</label>
                            <div class="input-group">
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
                            @error('password')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-12 mb-3" x-data="{ showConfirmPassword: false }">
                            <label class="form-label" for="password_confirmation">Confirm Password</label>
                            <div class="input-group">
                                <input :type="showConfirmPassword ? 'text' : 'password'" class="form-control"
                                    id="password_confirmation" wire:model="password_confirmation"
                                    name="password_confirmation" required>
                                <span class="input-group-text">
                                    <button type="button" @click="showConfirmPassword = !showConfirmPassword"
                                        class="toggle-password text-decoration-none text-muted d-flex border-0 outline-0 p-0 bg-transparent">
                                        <iconify-icon :icon="showConfirmPassword ? 'mdi:eye' : 'mdi:eye-off'"
                                            width="24" height="24"></iconify-icon>
                                    </button>
                                </span>
                            </div>
                            @error('password')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-12">
                            <div class="mb-2">
                                <button class="btn btn-secondary w-100">Reset</button>
                            </div>
                        </div>

                    </div>
                </form>

            </div>
        </div>
    </div>
</div>
