@extends('backend.layout.base')

@section('title')
    Admins Details
@endsection

@section('content')
    <div class="container-fluid">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="nk-block-head nk-block-head-sm">
                    <div class="nk-block-between">
                        <div class="nk-block-head-content">
                            <h3 class="nk-block-title page-title">
                                Show Admin
                            </h3>
                        </div>
                        <div class="nk-block-head-content">
                            <div class="toggle-wrap nk-block-tools-toggle">
                                <div class="toggle-expand-content" data-content="more-options">
                                    <ul class="nk-block-tools g-3">
                                        <li class="nk-block-tools-opt">
                                            <a class="btn btn-outline-light d-none d-md-inline-flex" href="{{ route('admins.users.admin.index') }}">
                                                <em class="icon ni ni-arrow-left"></em>
                                                <span>Back</span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="nk-block">
                    <div class="row justify-content-center">
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-body border-bottom py-3">
                                    <div class="text-center">
                                        <img
                                            src="{{ asset('assets/admins/images/man.webp') }}"
                                            title="{{ $admin->name }}"
                                            class="img-fluid user-avatar-xl mb-3 text-center rounded-circle border-danger"
                                        >
                                    </div>
                                    <table class="table">
                                        <tbody>
                                        <tr>
                                            <th>Name</th>
                                            <td>{{ ucfirst($admin->name) ?? "" }}</td>
                                        </tr>

                                        <tr>
                                            <th>Email</th>
                                            <td>{{ $admin->email ?? "" }}</td>
                                        </tr>

                                        <tr>
                                            <th>Institution Name</th>
                                            <td>{{ ucfirst($admin->institution->institution_name) ?? "" }}</td>
                                        </tr>

                                        <tr>
                                            <th>Institution Email</th>
                                            <td>{{ $admin->institution->institution_email ?? $admin->email }}</td>
                                        </tr>

                                        <tr class="text-justify">
                                            <th>Roles</th>
                                            <td>
                                                <div class="tb-lead d-flex flex-wrap">
                                                    @foreach($admin->roles as $role)
                                                        <span class="badge bg-primary mx-1 mb-1">{{$role->name ?? "" }}</span>
                                                    @endforeach
                                                </div>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
