<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>VINCO | Welcome to Vinco Learning School App</title>

    <link rel="shortcut icon" href="{{asset('assets/vinco_dark.svg')}}" type="image/x-icon">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">


    <style>
        body {
            font-family: 'Arial';
        }
    </style>
</head>
<body class="antialiased">
<div class="relative flex items-top justify-center min-h-screen bg-gray-100 light:bg-gray-900 sm:items-center sm:pt-0">
    @if (Route::has('login'))
        <div class="hidden fixed top-0 items-center px-6 py-4 sm:block">
            @auth
            @else
            @endif
            {{--            <a href="{{ url('/terms') }}" class="text-sm text-gray-500 underline ml-4">Terms</a>--}}
        </div>
    @endif

    <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
        <div class="mt-8 overflow-hidden shadow sm:rounded-lg">
            <div class="grid grid-cols-1 md:grid-cols-2">
                <div class="p-6 h-100 d-flex flex-column text-center align-items-center">
                    <div class="m-auto p-3">
                        <div class="mt-auto text-lg ">
                            <h1>
                                WELCOME TO VINCO SCHOOL LEARNING APP.
                            </h1>

                            @if (Route::has('login'))
                                <div class="hidden items-center px-6 py-4 sm:block">
                                    @auth
                                        <a href="{{route('admins.backend.home')}}" class="text-sm text-white btn btn-dark">GO TO LMS SYSTEME</a>

                                        <a href="{{route('admins.communication.message.index')}}" class="text-sm text-white btn btn-dark">GO TO COMMUNICATION</a>
                                    @else
                                        <a href="{{ route('login') }}" class="text-sm text-white btn btn-dark">LOGIN</a>
                                    @endif
                                    {{--            <a href="{{ url('/terms') }}" class="text-sm text-gray-500 underline ml-4">Terms</a>--}}
                                </div>
                            @endif
                        </div>
                    </div>
                </div>



                <div class="p-6 md:border-l">
                    <div class="ml-12">
                        <img src="{{asset('assets/vinco.svg')}}"
                             width="100%"
                             alt="skan-surveys-landing-page">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2"
        crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js"
        integrity="sha384-Xe+8cL9oJa6tN/veChSP7q+mnSPaj5Bcu9mPX5F5xIGE0DVittaqT5lorf0EI7Vk"
        crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.min.js"
        integrity="sha384-kjU+l4N0Yf4ZOJErLsIcvOU2qSb74wXpOhqTvwVx3OElZRweTnQ6d31fXEoRD1Jy"
        crossorigin="anonymous"></script>
</body>
</html>
