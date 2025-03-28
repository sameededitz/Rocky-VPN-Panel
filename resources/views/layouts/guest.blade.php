<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
    <title>@yield('title') | {{ config('app.name') }} </title>

    <link rel="icon" type="image/x-icon" href="{{ asset('src/assets/img/favicon.ico') }}" />

    <link href="{{ asset('layouts/css/light/loader.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('layouts/css/dark/loader.css') }}" rel="stylesheet" type="text/css" />
    <script src="{{ asset('layouts/loader.js') }}"></script>

    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:400,600,700" rel="stylesheet">
    <link href="{{ asset('src/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('layouts/css/light/plugins.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('layouts/css/dark/plugins.css') }}" rel="stylesheet" type="text/css" />

    <link href="{{ asset('src/assets/css/light/authentication/auth-boxed.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('src/assets/css/dark/authentication/auth-boxed.css') }}" rel="stylesheet"
        type="text/css" />

    <link rel="stylesheet" type="text/css" href="{{ asset('src/assets/css/light/elements/alert.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('src/assets/css/dark/elements/alert.css') }}">
    <!-- END GLOBAL MANDATORY STYLES -->

    <!-- Page Specific Styles -->
    @yield('styles')
</head>

<body class="form">

    <x-loader />

    <div class="auth-container d-flex">

        <div class="container mx-auto align-self-center">

            @yield('content')

        </div>

    </div>

    <!-- BEGIN GLOBAL MANDATORY SCRIPTS -->
    <script src="{{ asset('src/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('src/plugins/src/iconify/iconify-icon.min.js') }}"></script>
    <!-- END GLOBAL MANDATORY SCRIPTS -->

    @yield('scripts')

</body>

</html>
