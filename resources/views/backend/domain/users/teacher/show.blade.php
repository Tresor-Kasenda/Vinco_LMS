@extends('backend.layout.base')

@section('title')
    Professor Detail
@endsection

@section('content')
    <div class="container-fluid">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="nk-block-head nk-block-head-sm">
                    <div class="nk-block-between">
                        <div class="nk-block-head-content">
                            <h3 class="nk-block-title page-title">
                                Show Professor
                            </h3>
                        </div>
                        <div class="nk-block-head-content">
                            <div class="toggle-wrap nk-block-tools-toggle">
                                <div class="toggle-expand-content" data-content="more-options">
                                    <ul class="nk-block-tools g-3">
                                        <li class="nk-block-tools-opt">
                                            <a class="btn btn-outline-light d-none d-md-inline-flex"
                                               href="{{ route('admins.users.teacher.index') }}">
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
                                            @if($teacher->images)
                                                src="{{ asset('storage/'.$teacher->images) }}"
                                            @else
                                                src="{{ asset('assets/admins/images/man.webp') }}"
                                            @endif
                                            title="{{ $teacher->username }}"
                                            class="img-fluid user-avatar-xl mb-3 text-center rounded-circle border-danger"
                                        >
                                    </div>
                                    <table class="table">
                                        <tbody>
                                        <tr>
                                            <th>Name</th>
                                            <td>{{ ucfirst($teacher->username) ?? "" }}</td>
                                        </tr>
                                        <tr>
                                            <th>Firstname</th>
                                            <td>{{ ucfirst($teacher->fristname) ?? "" }}</td>
                                        </tr>
                                        <tr>
                                            <th>Last-Name</th>
                                            <td>{{ ucfirst($teacher->lastname) ?? "" }}</td>
                                        </tr>
                                        <tr>
                                            <th>Matricule</th>
                                            <td>{{ $teacher->matriculate ?? "" }}</td>
                                        </tr>
                                        <tr>
                                            <th>Institution</th>
                                            <td>
                                                {{ ucfirst($teacher->user->institution->institution_name) ?? "" }} <br>
                                                {{ $teacher->user->institution->institution_email ?? "" }}

                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Email</th>
                                            <td>{{ $teacher->email ?? "" }}</td>
                                        </tr>

                                        <tr>
                                            <th>Liste des cours</th>
                                            @if($teacher->courses)
                                                <td>
                                                    <ul class="link-list-opt">
                                                        @foreach($teacher->courses as $course)
                                                            <li>
                                                                <a href="{{ route('admins.academic.course.show', $course->id) }}">
                                                                    <em class="icon ni ni-book-read"></em>
                                                                    <span>{{ ucfirst($course->name) ?? "" }}</span>
                                                                </a>
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                </td>
                                            @endif
                                        </tr>

                                        <tr class="text-justify">
                                            <th>Phones</th>
                                            <td>{{ $teacher->phones ?? "" }}</td>
                                        </tr>
                                        <tr>
                                            <th>Genre</th>
                                            <td>
                                                @if($teacher->gender == 'male')
                                                    MASCULIN
                                                @else
                                                    FEMININ
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Address</th>
                                            <td>
                                                {{ $teacher->location ?? "" }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Nationalite</th>
                                            <td>
                                                {{ $teacher->nationality ?? "" }}
                                            </td>
                                        </tr>

                                        <tr class="text-justify">
                                            <th>Roles</th>
                                            <td>
                                                <div class="tb-lead d-flex flex-wrap">
                                                    @foreach($teacher->user->roles as $role)
                                                        <span
                                                            class="badge bg-primary mx-1 mb-1">{{$role->name ?? "" }}</span>
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
