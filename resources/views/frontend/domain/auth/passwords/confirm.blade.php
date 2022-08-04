@extends('layouts.app')

@section('title')
    Password Confirmed
@endsection

@section('content')
    <div class="nk-content">
        <div class="nk-split nk-split-page nk-split-md">
            <div class="nk-split-content nk-block-area nk-block-area-column nk-auth-container bg-white">
                <div class="nk-block nk-block-middle nk-auth-body">
                    <div class="brand-logo pb-5 text-center justify-center">
                        <a href="{{ route('home.index') }}" class="logo-link">
                            <img class="logo-light logo-img logo-img-lg"
                                 src="{{ asset('assets/apps/images/VincoWhite/SVG/Vinco color Eng.svg') }}"
                                 srcset="{{ asset('assets/apps/images/VincoWhite/SVG/Vinco color Eng.svg') }}"
                                 alt="logo">
                            <img class="logo-dark logo-img logo-img-lg"
                                 src="{{ asset('assets/apps/images/VincoWhite/SVG/Vinco color Eng.svg') }}"
                                 srcset="{{ asset('assets/apps/images/VincoWhite/SVG/Vinco color Eng.svg') }}"
                                 alt="logo-dark">
                        </a>
                    </div>
                    <div class="nk-block-head mb-4">
                        <div class="nk-block-head-content">
                            <h5 class="nk-block-title text-center">{{ __('Confirm Password') }}</h5>
                        </div>
                        {{ __('Please confirm your password before continuing.') }}
                    </div>
                    <form method="POST" action="{{ route('password.confirm') }}">
                        @csrf
                        <div class="form-group">
                            <div class="form-label-group">
                                <label class="form-label" for="password">{{ __('Password') }}</label>
                            </div>
                            <input
                                id="password"
                                type="password"
                                class="form-control form-control-lg @error('password') error @enderror"
                                name="password"
                                required
                                autocomplete="current-password"
                            >
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <button class="btn btn-primary btn-block btn-dim">
                                {{ __('Confirm Password') }}
                            </button>
                        </div>
                        @if (Route::has('password.request'))
                            <a class="btn btn-link" href="{{ route('password.request') }}">
                                {{ __('Forgot Your Password?') }}
                            </a>
                        @endif
                    </form>
                </div>
                <div class="nk-block nk-auth-footer">
                    <div class="mt-3">
                        <p>&copy; {{ now()->format('Y') }}. All Rights Reserved.</p>
                    </div>
                </div>
            </div>
            <div class="nk-split-content nk-split-stretch bg-abstract"></div>
        </div>
    </div>
@endsection
