@extends('backend.layout.base')

@section('title')
    Interro Show
@endsection

@section('content')
    <div class="container-fluid">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="nk-block-head nk-block-head-sm">
                    <div class="nk-block-between">
                        <div class="nk-block-head-content">
                            <h3 class="nk-block-title page-title">Interro Show</h3>
                        </div>
                        <div class="nk-block-head-content">
                            <div class="toggle-wrap nk-block-tools-toggle">
                                <div class="toggle-expand-content" data-content="more-options">
                                    <ul class="nk-block-tools g-3">
                                        <li class="nk-block-tools-opt">
                                            <a class="btn btn-dim btn-primary btn-sm" href="{{ route('admins.academic.interro.index') }}">
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
                                            @if($interro->course->images)
                                                src="{{ asset('storage/'.$interro->course->images) }}"
                                            @else
                                                src="{{ asset('assets/admins/images/default.png') }}"
                                            @endif
                                            title="{{ $interro->id }}"
                                            class="img-fluid user-avatar-xl mb-3 rounded-circle border-danger"
                                        >
                                    </div>
                                    <table class="table">
                                        <tbody>
                                        <tr>
                                            <th>Cours</th>
                                            <td>
                                                <a href="{{ route('admins.academic.course.show', $interro->course->id) }}">
                                                    {{ ucwords($interro->course->name) ?? "" }}
                                                </a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Chapitre</th>
                                            <td>
                                                <a href="{{ route('admins.academic.chapter.show', $interro->chapter->id) }}">
                                                    {{ ucwords($interro->chapter->name) ?? "" }}
                                                </a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Cote</th>
                                            <td>{{ ucfirst($interro->rating) ?? "" }}</td>
                                        </tr>
                                        <tr>
                                            <th>Date de l'epreuve</th>
                                            <td>{!! $interro->date ?? "" !!}</td>
                                        </tr>
                                        <tr>
                                            <th>Duree</th>
                                            <td>{!! $interro->duration ?? "" !!}</td>
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
