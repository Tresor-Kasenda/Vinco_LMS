<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" href="{{asset('assets/vinco_dark.svg')}}" type="image/x-icon">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link href="{{ asset('assets/apps/css/bootstrap.css') }}" rel="stylesheet" data-turbolinks-track="true">
    <link href="{{ asset('assets/apps/css/style.css') }}" rel="stylesheet" data-turbolinks-track="true">
    <link href="{{ asset('assets/apps/css/responsive.css') }}" rel="stylesheet" data-turbolinks-track="true">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.0/animate.min.css" rel="stylesheet" data-turbolinks-track="true">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <title>{{ config('app.name') }} | @yield('title')</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
</head>
<body class="hidden-bar-wrapper">
<div class="page-wrapper">
    @include('frontend.partial.header')
    @yield('content')
    @include('frontend.partial.footer')
</div>
<div class="scroll-to-top scroll-to-target" data-target="html"><span class="fa fa-arrow-up"></span></div>
<script src="{{ asset('assets/apps/js/jquery.js') }}" data-turbolinks-track="true"></script>
<script src="{{ asset('assets/apps/js/popper.min.js') }}" data-turbolinks-track="true"></script>
<script src="{{ asset('assets/apps/js/bootstrap.min.js') }}" data-turbolinks-track="true"></script>
<script src="{{ asset('assets/apps/js/jquery.mCustomScrollbar.concat.min.js') }}" data-turbolinks-track="true"></script>
<script src="{{ asset('assets/apps/js/jquery.fancybox.js') }}" data-turbolinks-track="true"></script>
<script src="{{ asset('assets/apps/js/appear.js') }}" data-turbolinks-track="true"></script>
<script src="{{ asset('assets/apps/js/parallax.min.js') }}" data-turbolinks-track="true"></script>
<script src="{{ asset('assets/apps/js/tilt.jquery.min.js') }}" data-turbolinks-track="true"></script>
<script src="{{ asset('assets/apps/js/jquery.paroller.min.js') }}" data-turbolinks-track="true"></script>
<script src="{{ asset('assets/apps/js/owl.js') }}" data-turbolinks-track="true"></script>
<script src="{{ asset('assets/apps/js/wow.js') }}" data-turbolinks-track="true"></script>
<script src="{{ asset('assets/apps/js/nav-tool.js') }}" data-turbolinks-track="true"></script>
<script src="{{ asset('assets/apps/js/jquery-ui.js') }}" data-turbolinks-track="true"></script>
<script src="{{ asset('assets/apps/js/script.js') }}" data-turbolinks-track="true"></script>
</body>
</html>
