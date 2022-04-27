<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link href="{{ asset('assets/apps/css/bootstrap.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/apps/css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/apps/css/responsive.css') }}" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <title>{{ config('app.name') }} | @yield('title')</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
</head>
<body class="hidden-bar-wrapper">
    <div class="page-wrapper">
        @include('apps.partial.header')
        @yield('content')
        @include('apps.partial.footer')
    </div>
    <div class="scroll-to-top scroll-to-target" data-target="html"><span class="fa fa-arrow-up"></span></div>
    <script src="{{ asset('assets/apps/js/jquery.js') }}"></script>
    <script src="{{ asset('assets/apps/js/popper.min.js') }}"></script>
    <script src="{{ asset('assets/apps/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/apps/js/jquery.mCustomScrollbar.concat.min.js') }}"></script>
    <script src="{{ asset('assets/apps/js/jquery.fancybox.js') }}"></script>
    <script src="{{ asset('assets/apps/js/appear.js') }}"></script>
    <script src="{{ asset('assets/apps/js/parallax.min.js') }}"></script>
    <script src="{{ asset('assets/apps/js/tilt.jquery.min.js') }}"></script>
    <script src="{{ asset('assets/apps/js/jquery.paroller.min.js') }}"></script>
    <script src="{{ asset('assets/apps/js/owl.js') }}"></script>
    <script src="{{ asset('assets/apps/js/wow.js') }}"></script>
    <script src="{{ asset('assets/apps/js/nav-tool.js') }}"></script>
    <script src="{{ asset('assets/apps/js/jquery-ui.js') }}"></script>
    <script src="{{ asset('assets/apps/js/script.js') }}"></script>
</body>
</html>
