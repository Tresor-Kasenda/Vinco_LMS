@extends('backend.layout.base')

@section('title')
    Chapter Details
@endsection

@section('content')
    <div class="container-fluid">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="nk-block-head nk-block-head-sm">
                    <div class="nk-block-between">
                        <div class="nk-block-head-content">
                            <h6 class="nk-block-title page-title">
                                Chapter Details
                            </h6>
                        </div>
                        <div class="nk-block-head-content">
                            <div class="toggle-wrap nk-block-tools-toggle">
                                <div class="toggle-expand-content" data-content="more-options">
                                    <ul class="nk-block-tools g-3">
                                        <li class="nk-block-tools-opt">
                                            <a class="btn btn-dim btn-primary btn-sm" href="{{ route('admins.academic.chapter.index') }}">
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
                                            @if($chapter->course->images)
                                                src="{{ asset('storage/'.$chapter->course->images) }}"
                                            @else
                                                src="{{ asset('assets/admins/images/man.webp') }}"
                                            @endif
                                            title="{{ $chapter->name }}"
                                            class="img-fluid user-avatar-xl mb-3 rounded-circle border-danger"
                                         alt="{{ $chapter->name }}">
                                    </div>
                                    <table class="table">
                                        <tbody>
                                            <tr>
                                                <th>Nom du cours</th>
                                                <td>
                                                    <a href="{{ route('admins.academic.course.show', $chapter->course->id) }}">
                                                        <em class="icon ni ni-book-read"></em>
                                                        {{ ucfirst($chapter->course->name) ?? "" }}
                                                    </a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>Titre du chapitre</th>
                                                <td>{{ ucfirst($chapter->name) ?? "" }}</td>
                                            </tr>
                                            <tr>
                                                <th>Leçons</th>
                                                <td>
                                                    @if($chapter->lessons)
                                                        @foreach($chapter->lessons as $lesson)
                                                            <li>
                                                                <a href="{{ route('admins.academic.lessons.show', $lesson->id) }}">
                                                                    <em class="icon ni ni-book"></em>
                                                                    <span>{{ ucfirst($lesson->name) ?? "" }}</span>
                                                                </a>
                                                            </li>
                                                        @endforeach
                                                    @endif
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>Professeurs</th>
                                                <td>
                                                    @if($chapter->course->professors)
                                                        @foreach($chapter->course->professors as $professor)
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
                                                <th>Description</th>
                                                <td>{!! $chapter->content ?? ""  !!}</td>
                                            </tr>
                                            <tr></tr>
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
