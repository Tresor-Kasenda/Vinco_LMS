@extends('backend.layout.base')

@section('title', "Gestion des results")

@section('content')
    <div class="container-fluid">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="nk-block-head nk-block-head-sm">
                    <div class="nk-block-between">
                        <div class="nk-block-head-content">
                            <h3 class="nk-block-title page-title">Exam Results List</h3>
                        </div>
                        <div class="nk-block-head-content">
                            <div class="toggle-wrap nk-block-tools-toggle">
                                <div class="toggle-expand-content" data-content="more-options">
                                    <ul class="nk-block-tools g-3">
                                        @can('result-create')
                                        <li class="nk-block-tools-opt">
                                            <a class="btn btn-dim btn-primary btn-sm" href="{{ route('admins.exam.exam-result.create') }}">
                                                <em class="icon ni ni-plus"></em>
                                                <span>Create</span>
                                            </a>
                                        </li>
                                        @endcan
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
                                <span>Images</span>
                            </th>
                            <th class="nk-tb-col">
                                <span>Nom du cours</span>
                            </th>
                            <th class="nk-tb-col">
                                <span>Categorie</span>
                            </th>
                            <th class="nk-tb-col">
                                <span>Professeur</span>
                            </th>
                            <th class="nk-tb-col">
                                <span>Nombre des chapitres</span>
                            </th>
                            <th class="nk-tb-col">
                                <span>Status</span>
                            </th>
                            <th class="nk-tb-col">
                                <span>Date de debut</span>
                            </th>
                            <th class="nk-tb-col nk-tb-col-tools text-center">
                                <ul class="nk-tb-actions gx-1 my-n1">
                                    <li class="me-n1">
                                        <div class="dropdown">
                                            <a href="#" class="dropdown-toggle btn btn-icon btn-trigger" data-bs-toggle="dropdown">
                                                <em class="icon ni ni-more-h"></em>
                                            </a>
                                        </div>
                                    </li>
                                </ul>
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($results as $course)
                            <tr class="nk-tb-item text-center">
                                <td class="nk-tb-col">
                                    <span class="tb-lead">
                                        <img
                                            src="{{ asset('storage/'.$course->images) }}"
                                            alt="{{ $course->name }}"
                                            class="img-fluid rounded-circle"
                                            width="20%"
                                            height="20%"
                                        >
                                    </span>
                                </td>
                                <td class="nk-tb-col">
                                    <span class="tb-lead">
                                       <h6 class="title">{{ $course->name ?? "" }}</h6>
                                    </span>
                                </td>
                                <td class="nk-tb-col">
                                    <span class="tb-lead">{{ $course->category->name ?? "" }}</span>
                                </td>
                                <td class="nk-tb-col">
                                    <span class="tb-lead">{{ strtoupper($course->user->name) ?? "" }} {{ strtoupper($course->user->firstName) ?? "" }}</span>
                                </td>
                                <td class="nk-tb-col">
                                    <span class="tb-lead">Total chapitres : {{ $course->chapters_count ?? "" }} </span>
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
                                    <span class="tb-lead">{{ $course->startDate ?? "" }} </span>
                                </td>
                                <td class="nk-tb-col nk-tb-col-tools">
                                    <ul class="nk-tb-actions gx-1 my-n1">
                                        <li class="me-n1">
                                            <div class="dropdown">
                                                <a href="#" class="dropdown-toggle btn btn-icon btn-trigger" data-bs-toggle="dropdown">
                                                    <em class="icon ni ni-more-h"></em>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-end">
                                                    <ul class="link-list-opt no-bdr">
                                                        <li>
                                                            <a href="{{ route('admins.exam.exam-result.show', $course->key) }}">
                                                                <em class="icon ni ni-eye"></em>
                                                                <span>View</span>
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <form action="{{ route('admins.exam.exam-result.destroy', $course->key) }}" method="POST" onsubmit="return confirm('Voulez vous supprimer');">
                                                                @method('DELETE')
                                                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                                <button type="submit" class="btn btn-dim">
                                                                    <em class="icon ni ni-trash"></em>
                                                                    <span>Remove</span>
                                                                </button>
                                                            </form>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
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
