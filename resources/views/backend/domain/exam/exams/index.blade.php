@extends('backend.layout.base')

@section('title')
    Liste des examens
@endsection

@section('content')
    <div class="container-fluid">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="nk-block-head nk-block-head-sm">
                    <div class="nk-block-between">
                        <div class="nk-block-head-content">
                            <h3 class="nk-block-title page-title">Liste des Examens</h3>
                        </div>
                        <div class="nk-block-head-content">
                            <div class="toggle-wrap nk-block-tools-toggle">
                                <div class="toggle-expand-content" data-content="more-options">
                                    <ul class="nk-block-tools g-3">
                                        <li class="nk-block-tools-opt">
                                            <a class="btn btn-dim btn-primary btn-sm" href="{{ route('admins.exam.exam.create') }}">
                                                <em class="icon ni ni-plus"></em>
                                                <span>Create</span>
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
                                    <span>ID</span>
                                </th>
                                <th class="nk-tb-col">
                                    <span>COURS</span>
                                </th>
                                <th class="nk-tb-col">
                                    <span>PONDERATION</span>
                                </th>
                                <th class="nk-tb-col">
                                    <span>DATE</span>
                                </th>
                                <th class="nk-tb-col">
                                    <span>DUREE</span>
                                </th>
                                <th class="nk-tb-col">
                                    <span>STATUS</span>
                                </th>
                                <th class="nk-tb-col">
                                    <span>ACTION</span>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($exams as $exam)
                            <tr class="nk-tb-item text-center">
                                <td class="nk-tb-col">
                                    <span class="tb-lead">
                                        {{ $exam->id ?? "" }}
                                    </span>
                                </td>
                                <td class="nk-tb-col">
                                    <span class="tb-lead">{{ ucfirst($exam->course->name) ?? "" }}</span>
                                </td>
                                <td class="nk-tb-col">
                                    <span class="tb-lead">{{ $exam->rating ?? "" }} </span>
                                </td>
                                <td class="nk-tb-col">
                                    <span class="tb-lead">{{ $exam->date ?? "" }} </span>
                                </td>
                                <td class="nk-tb-col">
                                    <span class="tb-lead">{{ $exam->duration ?? "" }} </span>
                                </td>
                                <td class="nk-tb-col">
                                    @if($exam->status)
                                        <span class="dot bg-success d-sm-none"></span>
                                        <span class="badge badge-sm badge-dot has-bg bg-success d-none d-sm-inline-flex">Confirmer</span>
                                    @else
                                        <span class="dot bg-warning d-sm-none"></span>
                                        <span class="badge badge-sm badge-dot has-bg bg-warning d-none d-sm-inline-flex">En attente</span>
                                    @endif
                                </td>
                                <td class="nk-tb-col">
                                    <span class="tb-lead">
                                        <div class="d-flex">
                                            <a href="{{ route('admins.exam.exam.show', $exam->id) }}" class="btn btn-dim btn-primary btn-sm ml-1">
                                                <em class="icon ni ni-eye"></em>
                                            </a>
                                            <a href="{{ route('admins.exam.exam.edit', $exam->id) }}" class="btn btn-dim btn-primary btn-sm ml-1">
                                                <em class="icon ni ni-edit"></em>
                                            </a>
                                            <form action="{{ route('admins.exam.exam.destroy', $exam->id) }}" method="POST" onsubmit="return confirm('Voulez vous supprimer');">
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
