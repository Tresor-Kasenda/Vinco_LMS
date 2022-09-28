<!DOCTYPE html>
<html lang="zxx" class="js">
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<head>
    <meta charset="utf-8">
    <meta name="author" content="Softnio">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="A powerful and conceptual apps base dashboard template that especially build for developers and programmers.">
    <link rel="shortcut icon" href="{{ asset('assets/frontend/images/VincoWhite/SVG/Vinco color Eng.svg') }}">
    <title>Vinco | @yield('title')</title>
    <link rel="stylesheet" href="{{ asset('assets/admins/css/css/dashlite41fe.css') }}" data-turbolinks-track="true">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.0/animate.min.css" rel="stylesheet" data-turbolinks-track="true">
</head>
<body class="nk-body bg-white npc-default pg-auth" >
    <div class="nk-app-root">
        <div class="nk-main ">
            <div class="nk-wrap nk-wrap-nosidebar">
                @yield('content')
            </div>
        </div>
    </div>
</body>
</html>
