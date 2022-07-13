@extends('backend.layout.base')

@section('title')
    Cours Lists
@endsection

@section('content')
    <div class="container-fluid">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="nk-block-head nk-block-head-sm">
                    <div class="nk-block-between">
                        <div class="nk-block-head-content">
                            <h3 class="nk-block-title page-title">Liste des Cours</h3>
                        </div>
                        <div class="nk-block-head-content">
                            <div class="toggle-wrap nk-block-tools-toggle">
                                <div class="toggle-expand-content" data-content="more-options">
                                    <ul class="nk-block-tools g-3">
                                        <li class="nk-block-tools-opt">
                                            <a class="btn btn-dim btn-primary btn-sm" href="{{ route('admins.academic.course.create') }}">
                                                <em class="icon ni ni-plus"></em>
                                                <span>Create</span>
                                            </a>
                                        </li>
                                        <li class="nk-block-tools-opt">
                                            <a class="btn btn-dim btn-secondary btn-sm" href="{{ route('admins.course.history') }}">
                                                <em class="icon ni ni-histroy"></em>
                                                <span>Corbeille</span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="nk-block">
                    <table class="datatable-init nowrap nk-tb-list is-separate" data-auto-responsive="false">
                        <thead>
                            <tr class="nk-tb-item nk-tb-head text-center">
                                <th class="nk-tb-col">
                                    <span>IMAGES</span>
                                </th>
                                <th class="nk-tb-col">
                                    <span>NAME</span>
                                </th>
                                <th class="nk-tb-col">
                                    <span>CATEGORIES</span>
                                </th>
                                <th class="nk-tb-col">
                                    <span>CHAPTERS</span>
                                </th>
                                <th class="nk-tb-col">
                                    <span>STATUS</span>
                                </th>
                                <th class="nk-tb-col">
                                    <span>PONDERATION</span>
                                </th>
                                <th class="nk-tb-col nk-tb-col-tools text-center">
                                    <span>ACTION</span>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($courses as $course)
                                <tr class="nk-tb-item text-center">
                                    <td class="nk-tb-col">
                                        <span class="tb-lead">
                                            <img
                                                src="{{ asset('storage/'.$course->images) }}"
                                                alt="{{ ucfirst(substr($course->name, 0, 20)) ?? "" }}"
                                                class="img-fluid rounded-circle"
                                                width="20%"
                                                height="20%"
                                            >
                                        </span>
                                    </td>
                                    <td class="nk-tb-col">
                                        <span class="tb-lead">
                                            <h6 class="title">{{ ucfirst(substr($course->name, 0, 20)) ?? "" }}...</h6>
                                        </span>
                                    </td>
                                    <td class="nk-tb-col">
                                        <span class="tb-lead">{{ ucfirst($course->category->name) ?? "" }}</span>
                                    </td>
                                    <td class="nk-tb-col">
                                        <span class="tb-lead">Nb Chapitres : {{ $course->chapters_count ?? "" }} </span>
                                    </td>
                                    <td class="nk-tb-col">
                                        @if($course->status)
                                            <span class="dot bg-success d-sm-none"></span>
                                            <span class="badge badge-sm badge-dot has-bg bg-success d-none d-sm-inline-flex">Confirmer</span>
                                        @else
                                            <span class="dot bg-warning d-sm-none"></span>
                                            <span class="badge badge-sm badge-dot has-bg bg-warning d-none d-sm-inline-flex">En attente</span>
                                        @endif
                                    </td>
                                    <td class="nk-tb-col">
                                        <span class="tb-lead">{{ $course->weighting ?? "" }} </span>
                                    </td>
                                    <td class="nk-tb-col">
                                        <span class="tb-lead">
                                            <div class="d-flex">
                                                <a href="{{ route('admins.academic.course.show', $course->id) }}" class="btn btn-dim btn-primary btn-sm ml-1">
                                                    <em class="icon ni ni-eye"></em>
                                                </a>
                                                <a href="{{ route('admins.academic.course.edit', $course->id) }}" class="btn btn-dim btn-primary btn-sm ml-1">
                                                    <em class="icon ni ni-edit"></em>
                                                </a>
                                                <form action="{{ route('admins.academic.course.destroy', $course->id) }}" method="POST" onsubmit="return confirm('Voulez vous supprimer');">
                                                    @method('DELETE')
                                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                    <button type="submit" class="btn btn-dim btn-danger btn-sm">
                                                        <em class="icon ni ni-trash"></em>
                                                    </button>
                                                </form>
                                            </div>
                                        </span>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
