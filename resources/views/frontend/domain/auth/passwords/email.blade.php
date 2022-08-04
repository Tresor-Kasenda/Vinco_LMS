@extends('frontend.layout.auth')

@section('title')
    Password Forget
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
                            <h5 class="nk-block-title text-center">{{ __('Reset Password') }}</h5>
                        </div>
                    </div>
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf
                        <div class="form-group">
                            <div class="form-label-group">
                                <label class="form-label" for="email">{{ __('Email Address') }}</label>
                            </div>
                            <input
                                type="text"
                                class="form-control form-control-lg @error('email') error @enderror"
                                id="email"
                                placeholder="Enter your email address"
                                name="email"
                                value="{{ old('email') }}"
                                required
                                autocomplete="email"
                            >
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <button class="btn btn-primary btn-block btn-dim">
                                {{ __('Send Password Reset Link') }}
                            </button>
                        </div>
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
