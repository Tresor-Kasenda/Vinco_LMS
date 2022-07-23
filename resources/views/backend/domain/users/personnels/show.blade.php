@extends('backend.layout.base')

@section('title')
    Show Personnel
@endsection

@section('content')
    <div class="container-fluid">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="nk-block-head nk-block-head-sm">
                    <div class="nk-block-between">
                        <div class="nk-block-head-content">
                            <h3 class="nk-block-title page-title">
                                Show Personnel
                            </h3>
                        </div>
                        <div class="nk-block-head-content">
                            <div class="toggle-wrap nk-block-tools-toggle">
                                <div class="toggle-expand-content" data-content="more-options">
                                    <ul class="nk-block-tools g-3">
                                        <li class="nk-block-tools-opt">
                                            <a class="btn btn-outline-light d-none d-md-inline-flex" href="{{ route('admins.users.staffs.index') }}">
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
                                                @if($employee->images_personnel)
                                                    src="{{ asset('storage/'.$employee->images_personnel) }}"
                                                @else
                                                    src="{{ asset('assets/admins/images/man.webp') }}"
                                                @endif
                                                title="{{ $employee->username }}"
                                                class="img-fluid user-avatar-xl mb-3 text-center rounded-circle border-danger"
                                            >
                                        </div>
                                        <table class="table">
                                            <tbody>
                                            <tr>
                                                <th>Name</th>
                                                <td>{{ ucfirst($employee->username) ?? "" }}</td>
                                            </tr>
                                            <tr>
                                                <th>Last-Name</th>
                                                <td>{{ ucfirst($employee->lastname) ?? "" }}</td>
                                            </tr>
                                            <tr>
                                                <th>Matricule</th>
                                                <td>{{ $employee->matriculate ?? "" }}</td>
                                            </tr>
                                            <tr>
                                                <th>Email</th>
                                                <td>{{ $employee->email ?? "" }}</td>
                                            </tr>
                                            <tr>
                                                <th>Annee academique</th>
                                                <td>
                                                    {{ \Carbon\Carbon::createFromFormat('Y-m-d', $employee->academic->start_date)->format('Y') }}
                                                    -
                                                    {{ \Carbon\Carbon::createFromFormat('Y-m-d', $employee->academic->end_date)->format('Y') }}
                                                </td>
                                            </tr>
                                            <tr class="text-justify">
                                                <th>Institution</th>
                                                <td>
                                                    <div class="tb-lead d-flex flex-wrap">
                                                        <span class="badge bg-primary mx-1 mb-1">{{ ucfirst($employee->user->institution->institution_name ) ?? "" }}</span>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr class="text-justify">
                                                <th>Phones</th>
                                                <td>{{ $employee->phones ?? "" }}</td>
                                            </tr>
                                            <tr>
                                                <th>Genre</th>
                                                <td>
                                                    @if($employee->gender == 'male')
                                                        MASCULIN
                                                    @else
                                                        FEMININ
                                                    @endif
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>Address</th>
                                                <td>
                                                    {{ $employee->location ?? "" }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>Nationalite</th>
                                                <td>
                                                    {{ $employee->nationality ?? "" }}
                                                </td>
                                            </tr>
                                            <tr class="text-justify">
                                                <th>Roles</th>
                                                <td>
                                                    <div class="tb-lead d-flex flex-wrap">
                                                        @foreach($employee->user->roles as $role)
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
