@extends('layouts.guest')
@section('title', 'Email Verified')
@section('content')
    <div class="row">
        <div class="col-xxl-4 col-xl-5 col-lg-5 col-md-8 col-12 d-flex flex-column align-self-center mx-auto">
            <div class="d-flex justify-content-center">
                <a href="{{ route('home') }}" wire:ignore class="text-decoration-none d-flex align-items-center gap-2">
                    <img src="{{ asset('src/assets/img/logo.svg') }}" width="80px" class="navbar-logo" alt="logo">
                    <h2 class="text-info">{{ config('app.name') }}</h2>
                </a>
            </div>
            <div class="card mt-3 mb-3">
                <div class="card-body text-center">

                    <img src="{{ asset('src/assets/svg/verified.svg') }}" width="200px" alt="verify-img" class="mb-24">
                    <h6 class="mb-16">Email Verified Successfully</h6>
                    <p class="text-secondary-light">Now you can Login!</p>

                </div>
            </div>
        </div>
    </div>
@endsection
