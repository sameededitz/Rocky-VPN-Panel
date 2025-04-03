@extends('layouts.app')
@section('title', 'Dashboard')

@section('styles')
    <link href="{{ asset('src/plugins/src/apex/apexcharts.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('src/assets/css/light/dashboard/dash_1.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('src/assets/css/dark/dashboard/dash_1.css') }}" rel="stylesheet" type="text/css" />

    <link href="{{ asset('src/assets/css/light/elements/infobox.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('src/assets/css/dark/elements/infobox.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
    <livewire:admin.dashboard-stats />

    <div class="row layout-top-spacing">

        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 layout-spacing">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="card-title mb-0">All Users</h5>
                    <a href="{{ route('user.create') }}"
                        class="btn btn-outline-info _effect--ripple waves-effect waves-light">
                        Create User
                    </a>
                </div>
                <div class="card-body">
                    <livewire:admin.users />
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('src/plugins/src/apex/apexcharts.min.js') }}"></script>
    <script src="{{ asset('src/assets/js/dashboard/dash_1.js') }}"></script>
@endsection
