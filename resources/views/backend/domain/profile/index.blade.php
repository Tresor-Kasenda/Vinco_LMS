@extends('backend.layout.base')

@section('title', "Profile")

@section('content')
    <div class="container-fluid">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="nk-block">
                    <div class="row g-gs">
                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-inner">
                                    <div class="card-body p-4 text-center">
                                        <span class="mb-3">
                                            @if(auth()->user()->profile)
                                                <img
                                                    class="img-fluid rounded-circle"
                                                    style="height: 45%; width: 45%"
                                                    src="{{ asset('assets/admins/images/profile.jpg') }}"
                                                    alt="{{ auth()->user()->name }}">
                                            @else
                                                <img
                                                    class="img-fluid rounded-circle"
                                                    style="height: 45%; width: 45%"
                                                    src="{{ asset('assets/admins/images/profile.jpg') }}"
                                                    alt="{{ auth()->user()->name }}">
                                            @endif
                                        </span>
                                        <h5 class="mt-1 mb-1">
                                            <a href="#">Admin</a>
                                        </h5>
                                        <span class="m-0 mb-1">
                                            <a href="#">{{ auth()->user()->email }}</a>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="row g-gs">
                                <div class="col-md-12 mb-2">
                                    <div class="card">
                                        <div class="card-header border-bottom">Profile setting</div>
                                        <div class="card-body">
                                            <form action="#" enctype="multipart/form-data" method="post">
                                                @csrf
                                                <div class="form-group mb-3 row">
                                                    <label class="form-label col-3 col-form-label" for="name">Name</label>
                                                    <div class="col">
                                                        <div class="form-control-wrap">
                                                            <input
                                                                type="text"
                                                                class="form-control"
                                                                name="name"
                                                                value="{{ old('name') ?? auth()->user()->name }}"
                                                                id="name">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group mb-3 row">
                                                    <label class="form-label col-3 col-form-label" for="lastname">First name</label>
                                                    <div class="col">
                                                        <div class="form-control-wrap">
                                                            <input
                                                                type="text"
                                                                class="form-control"
                                                                name="lastname"
                                                                value="{{ old('lastname') ?? auth()->user()->firstName }}"
                                                                id="lastname">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group mb-3 row">
                                                    <label class="form-label col-3 col-form-label" for="email">Email</label>
                                                    <div class="col">
                                                        <div class="form-control-wrap">
                                                            <input
                                                                type="text"
                                                                class="form-control"
                                                                name="email"
                                                                value="{{ old('email') ?? auth()->user()->email }}"
                                                                id="email">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group mb-3 row">
                                                    <label class="form-label col-3 col-form-label" for="image">Image</label>
                                                    <div class="col">
                                                        <div class="form-control-wrap">
                                                            <input
                                                                type="file"
                                                                class="form-control"
                                                                name="image"
                                                                value="{{ old('image') }}"
                                                                id="image">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <button type="submit" class="btn btn-primary">Update Profile</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="card">
                                        <div class="card-header bg-light border-bottom">Change password</div>
                                        <div class="card-body">
                                            <form action="#" method="post">
                                                @csrf
                                                <div class="form-group mb-3 row">
                                                    <label class="form-label col-3 col-form-label" for="current_password">Current Password</label>
                                                    <div class="col">
                                                        <div class="form-control-wrap">
                                                            <input
                                                                type="password"
                                                                class="form-control"
                                                                name="current_password"
                                                                value="{{ old('current_password') }}"
                                                                placeholder="Current Password"
                                                                id="current_password">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group mb-3 row">
                                                    <label class="form-label col-3 col-form-label" for="password">New Password</label>
                                                    <div class="col">
                                                        <div class="form-control-wrap">
                                                            <input
                                                                type="password"
                                                                class="form-control"
                                                                name="password"
                                                                value="{{ old('password') }}"
                                                                placeholder="New Password"
                                                                id="password">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <button type="submit" class="btn btn-primary">Update Password</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
