<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>VINCO | Welcome to Vinco Learning School App</title>

    <link rel="shortcut icon" href="{{asset('assets/vinco_dark.svg')}}" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <style>
        body {
            font-family: 'Arial';
            background-color: #040d21;
            color: white
        }
    </style>
</head>
<body>
    <div class="container h-100 w-100">
        <div class="row mt-4">
            <div class="d-flex justify-content-end">
                @if (Route::has('login'))
                    @auth
                        <a href="{{route('admins.backend.home')}}"
                           class="btn btn-outline-light w-auto h-auto d-inline my-2 my-sm-0 me-2" type="submit">
                            Go TO LMS Dashboard
                        </a>
                        <a href="{{route('admins.communication.calendar.index')}}"
                           class="btn btn-outline-light w-auto h-auto d-inline my-2 my-sm-0" type="submit">
                            Go TO Communication Dashboard
                        </a>
                    @else
                        <a href="{{route('login')}}"
                           class="btn btn-outline-light w-auto h-auto d-inline my-2 my-sm-0" type="submit">
                            Login
                        </a>
                    @endif
                @endif
            </div>
        </div>
        <div class="row">
            <div class="col-lg-8">
                <div style="margin-top: 200px">
                    <h1 style="font-family: Arial, Helvetica, sans-serif;
                        font-weight: bolder;
                        letter-spacing: -0.05em !important;
                        font-size: 100px">
                        Vinco Education Application
                    </h1>
                    <p class="w-75" style="font-family: Arial, Helvetica, sans-serif;
                        line-height: 32px;
                        color: #8193b2;
                        font-size: 24px">
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Beatae consectetur consequuntur cupiditate deleniti dolore expedita fugit id laboriosam laudantium minima neque non odit officiis ratione sed suscipit ut, voluptate voluptatibus!
                    </p>
                </div>
            </div>
            <div class="col-lg-4">
                <div>
                    <img
                        src="{{asset('assets/student.png')}}"
                        alt="home-page-landing-student"
                        class="h-75 w-75 me-5 text-white w-auto position-absolute bottom-0 end-0"/>
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
