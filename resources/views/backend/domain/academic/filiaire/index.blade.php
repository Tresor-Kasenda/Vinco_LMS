@extends('backend.layout.base')

@section('title')
    Gestion des filiaire
@endsection

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
                                        @can('filiaire-create')
                                            <li class="nk-block-tools-opt">
                                                <a class="btn btn-outline-primary btn-sm" href="{{ route('admins.academic.filiaire.create') }}">
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
                            <tr class="nk-tb-item nk-tb-head  text-center">
                                <th class="nk-tb-col tb-col-sm">
                                    <span>ID</span>
                                </th>
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
                                @if(auth()->user()->hasRole('Super Admin'))
                                    <th class="nk-tb-col">
                                        <span>INSTITUTION</span>
                                    </th>
                                @endif
                                <th class="nk-tb-col">
                                    Action
                                </th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach($filiaires as $filiaire)
                                <tr class="nk-tb-item text-center">
                                    <td class="nk-tb-col">
                                        <span class="tb-lead">{{ $filiaire->id ?? ""}}</span>
                                    </td>
                                    <td class="nk-tb-col">
                                        <span class="tb-product">
                                            <img
                                                src="{{ asset('storage/'. $filiaire->images) }}"
                                                alt="{{ $filiaire->name }}"
                                                class="thumb">
                                        </span>
                                    </td>
                                    <td class="nk-tb-col">
                                        <span class="tb-lead">{{ ucfirst($filiaire->name) ?? ""}}</span>
                                    </td>
                                    <td class="nk-tb-col">
                                        <span class="tb-lead">{{ ucfirst($filiaire->user->name) ?? "" }}</span>
                                    </td>
                                    <td class="nk-tb-col">
                                        <span class="tb-lead">{{ ucfirst($filiaire->department->name) ?? ""}}</span>
                                    </td>
                                    @if(auth()->user()->hasRole('Super Admin'))
                                        <th class="nk-tb-col">
                                            <span class="tb-lead">{{ ucfirst($filiaire->department->campus->institution->institution_name) ?? ""}}</span>
                                        </th>
                                    @endif
                                    <td class="nk-tb-col">
                                        @can('filiaire-view')
                                            <div class="tb-lead justify-content-center">
                                                <a href="{{ route('admins.academic.filiaire.show', $filiaire->id) }}"
                                                   class="btn btn-outline-primary btn-sm" title="">
                                                    <em class="icon ni ni-eye-alt-fill"></em>
                                                    <span>Detail Filiaire</span>
                                                </a>
                                            </div>
                                        @endcan
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
