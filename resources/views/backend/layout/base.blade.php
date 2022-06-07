<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="js">
<meta http-equiv="content-type" content="text/html;charset=UTF-8"/>
<head>
    <meta charset="utf-8">
    <meta name="author" content="Softnio">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="for developers and programmers.">
    <link rel="shortcut icon" href="">
    <title>LMS | @yield('title')</title>
    <link rel="stylesheet" href="{{ asset('assets/admins/css/css/dashlite41fe.css') }}">
    @yield('styles')
    @livewireStyles
</head>
<body class="nk-body bg-lighter npc-general has-sidebar">
    <div class="nk-app-root">
        <div class="nk-main ">
            @include('backend.partials.sidebar')
            <div class="nk-wrap ">
                @include('backend.partials.header')
                <div class="nk-content">
                    @yield('content')
                </div>
                <div class="nk-footer">
                    @include('backend.partials.footer')
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('js/admins.js') }}"></script>
    @yield('scripts')
    @livewireScripts
    @flasher_render
</body>
</html>
