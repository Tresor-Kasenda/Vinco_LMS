@extends('apps.layout.auth')

@section('content')
    <div class="nk-content">
        <div class="nk-split nk-split-page nk-split-md">
            <div class="nk-split-content nk-block-area nk-block-area-column nk-auth-container bg-white">
                <div class="nk-block nk-block-middle nk-auth-body">
                    <div class="brand-logo pb-5 text-center justify-center">
                        <a href="{{ route('home.index') }}" class="logo-link">
                            <img class="logo-light logo-img logo-img-lg" src="{{ asset('assets/apps/images/VincoWhite/1.5x/Vinco color Frenchhdpi.png') }}" srcset="{{ asset('assets/apps/images/VincoWhite/1.5x/Vinco color Frenchhdpi.png') }}" alt="logo">
                            <img class="logo-dark logo-img logo-img-lg" src="{{ asset('assets/apps/images/VincoWhite/1.5x/Vinco color Frenchhdpi.png') }}" srcset="{{ asset('assets/apps/images/VincoWhite/1.5x/Vinco color Frenchhdpi.png') }}" alt="logo-dark">
                        </a>
                    </div>
                    <div class="nk-block-head">
                        <div class="nk-block-head-content">
                            <h5 class="nk-block-title">Authentificiation</h5>
                        </div>
                    </div>
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="form-group">
                            <div class="form-label-group">
                                <label class="form-label" for="email">Email</label>
                            </div>
                            <input
                                type="text"
                                class="form-control form-control-lg @error('email') error @enderror"
                                id="email"
                                placeholder="Enter your email address or username"
                                name="email"
                                value="{{ old('email') }}"
                                required
                                autocomplete="email"
                                autofocus
                            >
                        </div>
                        <div class="form-group">
                            <div class="form-label-group">
                                <label class="form-label" for="password">Mot de passe</label>
                            </div>
                            <div class="form-control-wrap">
                                <a tabindex="-1" href="#" class="form-icon form-icon-right passcode-switch" data-target="password">
                                    <em class="passcode-icon icon-show icon ni ni-eye"></em>
                                    <em class="passcode-icon icon-hide icon ni ni-eye-off"></em>
                                </a>
                                <input
                                    type="password"
                                    class="form-control form-control-lg @error('email') error @enderror"
                                    id="password"
                                    placeholder="Enter your passcode"
                                    name="password"
                                    required
                                    autocomplete="current-password"
                                >
                            </div>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-lg btn-primary btn-block">Connexion</button>
                        </div>
                    </form>
                    <div class="text-center pt-4 pb-3">
                        <h6 class="overline-title overline-title-sap">
                            <span>OR</span>
                        </h6>
                    </div>
                    <ul class="nav justify-center gx-4">
                        <li class="nav-item">
                            <a class="nav-link" href="#">Facebook</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Google</a>
                        </li>
                    </ul>
                </div>
                <div class="nk-block nk-auth-footer">
                    <div class="nk-block-between">
                        <ul class="nav nav-sm text-center">
                            <li class="nav-item">
                                <a class="nav-link" href="#">Terms & Condition</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">Privacy Policy</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">Help</a>
                            </li>
                        </ul>
                    </div>
                    <div class="mt-3">
                        <p>&copy; {{ now()->format('Y') }}. All Rights Reserved.</p>
                    </div>
                </div>
            </div>
            <div class="nk-split-content nk-split-stretch bg-abstract"></div>
        </div>
    </div>
@endsection
