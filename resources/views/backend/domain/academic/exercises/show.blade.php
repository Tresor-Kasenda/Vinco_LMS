@extends('backend.layout.base')

@section('title', "Detail sur l'exercice")

@section('content')
    <div class="container-fluid">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="nk-block-head nk-block-head-sm">
                    <div class="nk-block-between">
                        <div class="nk-block-head-content">
                            <h6 class="nk-block-title page-title">
                                Exercise Details
                            </h6>
                        </div>
                        <div class="nk-block-head-content">
                            <div class="toggle-wrap nk-block-tools-toggle">
                                <div class="toggle-expand-content" data-content="more-options">
                                    <ul class="nk-block-tools g-3">
                                        <li class="nk-block-tools-opt">
                                            <a class="btn btn-dim btn-primary btn-sm" href="{{ route('admins.academic.exercice.index') }}">
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
                                            @if($exercise->lesson->chapter->course->images)
                                                src="{{ asset('storage/'.$exercise->lesson->chapter->course->images) }}"
                                            @else
                                                src="{{ asset('assets/admins/images/default.png') }}"
                                            @endif
                                            title="{{ $exercise->name }}"
                                            class="img-fluid user-avatar-xl mb-3 rounded-circle border-danger"
                                        >
                                    </div>
                                    <table class="table">
                                        <tbody>
                                        <tr></tr>
                                        <tr>
                                            <th>Cours</th>
                                            <td>{{ ucwords($exercise->lesson->chapter->course->name) ?? "" }}</td>
                                        </tr>
                                        <tr>
                                            <th>Chapitre</th>
                                            <td>{{ ucwords($exercise->lesson->chapter->name) ?? "" }}</td>
                                        </tr>
                                        <tr>
                                            <th>Professeur</th>
                                            <td>{{ ucwords($exercise->lesson->chapter->course->user->name) ?? "" }}</td>
                                        </tr>
                                        <tr>
                                            <th>Title du lecon</th>
                                            <td>{{ ucfirst($exercise->name) ?? "" }}</td>
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
