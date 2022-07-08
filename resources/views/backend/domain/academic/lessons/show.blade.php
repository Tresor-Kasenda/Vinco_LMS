@extends('backend.layout.base')

@section('title', "Detail sur la lecon")

@section('content')
    <div class="container-fluid">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="nk-block-head nk-block-head-sm">
                    <div class="nk-block-between">
                        <div class="nk-block-head-content">
                            <h6 class="nk-block-title page-title">
                                Lecon Details
                            </h6>
                        </div>
                        <div class="nk-block-head-content">
                            <div class="toggle-wrap nk-block-tools-toggle">
                                <div class="toggle-expand-content" data-content="more-options">
                                    <ul class="nk-block-tools g-3">
                                        <li class="nk-block-tools-opt">
                                            <a class="btn btn-dim btn-primary btn-sm" href="{{ route('admins.academic.lessons.index') }}">
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
                                            @if($lesson->chapter->course->images)
                                                src="{{ asset('storage/'.$lesson->chapter->course->images) }}"
                                            @else
                                                src="{{ asset('assets/admins/images/default.png') }}"
                                            @endif
                                            title="{{ $lesson->name }}"
                                            class="img-fluid user-avatar-xl mb-3 rounded-circle border-danger"
                                        >
                                    </div>
                                    <table class="table">
                                        <tbody>
                                        <tr>
                                            <th>Cours</th>
                                            <td>
                                                <a href="{{ route('admins.academic.course.show', $lesson->chapter->course->id) }}">
                                                    {{ ucwords($lesson->chapter->course->name) ?? "" }}
                                                </a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Chapitre</th>
                                            <td>
                                                <a href="{{ route('admins.academic.chapter.show', $lesson->chapter->id) }}">
                                                    {{ ucwords($lesson->chapter->name) ?? "" }}
                                                </a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Professeur</th>
                                            <td>
                                                @if($lesson->chapter->course->professors)
                                                    @foreach($lesson->chapter->course->professors as $professor)
                                                        <li>
                                                            <a href="{{ route('admins.users.teacher.show', $professor->id) }}">
                                                                <em class="icon ni ni-user"></em>
                                                                <span>{{ ucfirst($professor->username) ?? "" }} {{ ucfirst($professor->lastname) ?? "" }}</span>
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a href="{{ route('admins.users.teacher.show', $professor->id) }}">
                                                                <em class="icon ni ni-emails"></em>
                                                                <span>{{ $professor->email ?? "" }}</span>
                                                            </a>
                                                        </li>
                                                    @endforeach
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Title du lecon</th>
                                            <td>{{ ucfirst($lesson->name) ?? "" }}</td>
                                        </tr>
                                        <tr>
                                            <th>Description</th>
                                            <td>{!! $lesson->content ?? "" !!}</td>
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
