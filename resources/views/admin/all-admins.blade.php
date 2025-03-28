@extends('layouts.app')
@section('title', 'Admins')

@section('styles')
    <link href="{{ asset('src/assets/css/light/elements/custom-pagination.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('src/assets/css/dark/elements/custom-pagination.css') }}" rel="stylesheet" type="text/css" />

    <link href="{{ asset('src/plugins/src/sweetalerts2/sweetalerts2.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('src/plugins/css/light/sweetalerts2/custom-sweetalert.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('src/plugins/css/dark/sweetalerts2/custom-sweetalert.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
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
                    <li class="breadcrumb-item active" aria-current="page">Admins</li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- BREADCRUMB -->

    <div class="row layout-top-spacing">

        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 layout-spacing">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="card-title mb-0">All Admins</h5>
                    <a href="{{ route('admin.add') }}"
                        class="btn btn-outline-info _effect--ripple waves-effect waves-light">
                        Create Admin
                    </a>
                </div>
                <div class="card-body">
                    <livewire:admin.admins />
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script src="{{ asset('src/plugins/src/sweetalerts2/sweetalerts2.min.js') }}"></script>
    <script src="{{ asset('src/plugins/src/sweetalerts2/custom-sweetalert.js') }}"></script>
@endsection
