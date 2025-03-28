@extends('layouts.app')
@section('title', 'VPS Manager')

@section('styles')
    <link href="{{ asset('src/assets/css/light/elements/custom-pagination.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('src/assets/css/dark/elements/custom-pagination.css') }}" rel="stylesheet" type="text/css" />

    <link href="{{ asset('src/plugins/src/sweetalerts2/sweetalerts2.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('src/plugins/css/light/sweetalerts2/custom-sweetalert.css') }}" rel="stylesheet" type="text/css" />

    <link href="{{ asset('src/plugins/src/apex/apexcharts.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('src/plugins/css/light/apex/custom-apexcharts.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('src/plugins/css/dark/apex/custom-apexcharts.css') }}" rel="stylesheet" type="text/css">

    <link href="{{ asset('src/assets/css/light/widgets/modules-widgets.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('src/assets/css/dark/widgets/modules-widgets.css') }}" rel="stylesheet" type="text/css">
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
                    <li class="breadcrumb-item">
                        <a href="{{ route('vps-servers') }}" class="d-flex align-items-center">
                            VPS Servers
                        </a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Manager</li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- BREADCRUMB -->

    <livewire:admin.vps-manager lazy :server="$server" />
@endsection
@section('scripts')
    <script src="{{ asset('src/plugins/src/sweetalerts2/sweetalerts2.min.js') }}"></script>

    <script src="{{ asset('src/plugins/src/apex/apexcharts.min.js') }}"></script>
    {{-- <script src="{{ asset('src/plugins/src/apex/custom-apexcharts.js') }}"></script> --}}
@endsection
