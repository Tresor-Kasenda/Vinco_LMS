@extends('backend.layout.base')

@section('title', "Gestion des filiaire")

@section('content')
    <div class="container-fluid">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="nk-block-head nk-block-head-sm">
                    <div class="nk-block-between">
                        <div class="nk-block-head-content">
                            <h3 class="nk-block-title page-title">Gestion des filiaire</h3>
                        </div>
                        <div class="nk-block-head-content">
                            <div class="toggle-wrap nk-block-tools-toggle">
                                <div class="toggle-expand-content" data-content="more-options">
                                    <ul class="nk-block-tools g-3">
                                        <li class="nk-block-tools-opt">
                                            <a class="btn btn-dim btn-primary btn-sm" href="{{ route('admins.academic.filiaire.create') }}">
                                                <em class="icon ni ni-plus"></em>
                                                <span>Create</span>
                                            </a>
                                        </li>
                                        <li class="nk-block-tools-opt">
                                            <a class="btn btn-dim btn-secondary btn-sm" href="{{ route('admins.departments.history') }}">
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
                            <tr class="nk-tb-item nk-tb-head  text-center">
                                <th class="nk-tb-col tb-col-sm">
                                    <span>Image</span>
                                </th>
                                <th class="nk-tb-col">
                                    <span>Nom du filiaire</span>
                                </th>
                                <th class="nk-tb-col">
                                    <span>Responsable</span>
                                </th>
                                <th class="nk-tb-col">
                                    <span>Departement</span>
                                </th>
                                <th class="nk-tb-col">
                                    <span>Annee academique</span>
                                </th>
                                <th class="nk-tb-col">
                                    <span>Status</span>
                                </th>
                                <th class="nk-tb-col">
                                    Action
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($filiaires as $filiaire)
                                <tr class="nk-tb-item text-center">
                                    <td class="nk-tb-col">
                                        <span class="tb-product">
                                            <img
                                                src="{{ asset('storage/'. $filiaire->images) }}"
                                                alt="{{ $filiaire->name }}"
                                                class="thumb">
                                        </span>
                                    </td>
                                    <td class="nk-tb-col">
                                        <span class="tb-lead">{{ strtoupper($filiaire->name) ?? ""}}</span>
                                    </td>
                                    <td class="nk-tb-col">
                                        <span class="tb-lead">{{ strtoupper($filiaire->user->name) ?? "" }}</span>
                                    </td>
                                    <td class="nk-tb-col">
                                        <span class="tb-lead">{{ $filiaire->department->name ?? ""}}</span>
                                    </td>
                                    <td class="nk-tb-col">
                                        <span class="tb-lead">{{ $filiaire->academic->startDate ?? ""}}-{{ $filiaire->academic->endDate ?? ""}}</span>
                                    </td>
                                    <td class="nk-tb-col">
                                        @if($filiaire->status)
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
                                                <a href="{{ route('admins.academic.filiaire.edit', $filiaire->key) }}" class="btn btn-dim btn-primary btn-sm ml-1">
                                                    <em class="icon ni ni-edit"></em>
                                                </a>
                                                    <a href="{{ route('admins.academic.filiaire.show', $filiaire->key) }}" class="btn btn-dim btn-primary btn-sm ml-1">
                                                    <em class="icon ni ni-eye"></em>
                                                </a>
                                                <form action="{{ route('admins.academic.filiaire.destroy', $filiaire->key) }}" method="POST" onsubmit="return confirm('Voulez vous supprimer');">
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
