<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>VINCO | Welcome to Vinco Learning School App</title>

    <link rel="shortcut icon" href="{{asset('assets/vinco_dark.svg')}}" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            font-family: 'Arial';
            background-color: #040d21;
            color: white
        }

        .header_text{
            margin-top: 200px
        }

        .header_text_title{
            font-family: Arial, Helvetica, sans-serif;
            font-weight: bolder;
            letter-spacing: -0.05em !important;
            font-size: 100px
        }

        .header_text_description{
            font-family: Arial, Helvetica, sans-serif;
            line-height: 32px;
            color: #8193b2;
            font-size: 24px
        }

        .img_children{
            position: absolute;
            height: 75%;
            width: 75%;
            bottom: 0;
            end: 0;
        }

        @media only screen and (max-width: 768px) {
            .header_text{
                margin-top: 50px;
            }

            .header_text_title{
                font-size: 50px;
            }

            .header_text_description{
                font-size: 15px;
                line-height: 1.2;
            }

            .img_children{
                position: absolute;
                bottom: 0px;
                right: 0;
                height: 50%;
                width: 50%;
            }
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
                    <div class="me-3">
                        <div class="dropdown">
                            <a class="btn btn-light"
                               href="{{route('home.institution.register')}}"
                                    type="button" >
                                Créer une institution
                            </a>
                        </div>
                    </div>
                    <div class="me-3">
                        <div class="dropdown">
                            <button class="btn btn-light dropdown-toggle"
                                    type="button" id="dropdownMenuButton2" data-bs-toggle="dropdown" aria-expanded="false">
                                Inscription
                            </button>
                            <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="dropdownMenuButton2">
                                <li><a class="dropdown-item"
                                       href="{{route('home.student.register', ['$institution_id'=>1])}}"
                                    >Vinco Education</a></li>
                                <li><a class="dropdown-item"
                                       data-bs-toggle="modal" data-bs-target="#institutionModalRegister"
                                    >Choisir une institution</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="dropdown">
                        <button class="btn btn-light dropdown-toggle"
                                type="button" id="dropdownMenuButton2" data-bs-toggle="dropdown" aria-expanded="false">
                            Connexion
                        </button>
                        <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="dropdownMenuButton2">
                            <li><a class="dropdown-item" href="{{route('login')}}">Vinco Education</a></li>
                            <li><a class="dropdown-item"
                                   data-bs-toggle="modal" data-bs-target="#institutionModalLogin"
                                >
                                    Choisir votre institution
                                </a></li>
                        </ul>
                    </div>
                @endif
            @endif
        </div>
    </div>
    <div class="row">
        <div class="col-lg-8 col-6">
            <div class="header_text">
                <h1 class="header_text_title">
                    Vinco Education Application
                </h1>
                <p class="w-75 header_text_description">
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Beatae consectetur consequuntur cupiditate deleniti dolore expedita fugit id laboriosam laudantium minima neque non odit officiis ratione sed suscipit ut, voluptate voluptatibus!
                </p>
            </div>
        </div>
        <div class="col-lg-4 col-sm-12">
            <div>
                <img
                    src="{{asset('assets/student.png')}}"
                    alt="home-page-landing-student"
                    class="img_children me-5 text-white w-auto"/>
            </div>
        </div>
    </div>
</div>

    @auth
    @else
        <!-- Modal -->
        <div class="modal fade" id="institutionModalLogin" tabindex="-1" aria-labelledby="institutionModalLoginLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content bg-dark">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Choix de l'Institution</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        @forelse(\App\Models\Institution::all() as $institution)
                            <div class="row m-2">
                                <a type="button" class="btn btn-outline-light" href="{{route('login')}}">
                                    {{$institution->institution_name}} / {{$institution->institution_town}} / {{$institution->institution_country}}
                                </a>
                            </div>
                        @empty
                            <div class="row m-2">
                                <a type="button" class="btn btn-outline-light" href="">
                                    Pas d'institution disponible pour l'instant.
                                </a>
                            </div>
                        @endforelse
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="institutionModalRegister" tabindex="-1"
             aria-labelledby="institutionModalRegisterLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content bg-dark">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Choix de l'Institution</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        @forelse(\App\Models\Institution::all() as $institution)
                            <div class="row m-2">
                                <a type="button" class="btn btn-outline-light"
                                   href="{{route('home.student.register', ['$institution_id'=>$institution->id])}}">
                                    {{$institution->institution_name}} / {{$institution->institution_town}} / {{$institution->institution_country}}
                                </a>
                            </div>
                        @empty
                            <div class="row m-2">
                                <a type="button" class="btn btn-outline-light" href="">
                                    Pas d'institution disponible pour l'instant.
                                </a>
                            </div>
                        @endforelse
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>

    @endauth

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
