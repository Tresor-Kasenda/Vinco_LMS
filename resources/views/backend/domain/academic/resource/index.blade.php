@extends('backend.layout.base')

@section('title')
    Resource Listes
@endsection

@section('content')
    <div class="container-fluid">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="nk-block-head nk-block-head-sm">
                    <div class="nk-block-between">
                        <div class="nk-block-head-content">
                            <h3 class="nk-block-title page-title">Liste des resources</h3>
                        </div>
                        <div class="nk-block-head-content">
                            <div class="toggle-wrap nk-block-tools-toggle">
                                <div class="toggle-expand-content" data-content="more-options">
                                    <ul class="nk-block-tools g-3">
                                        @can('resource-create')
                                            <li class="nk-block-tools-opt">
                                                <a class="btn btn-dim btn-primary btn-sm" href="{{ route('admins.academic.resource.create') }}">
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
                                <span>NUMERO</span>
                            </th>
                            <th class="nk-tb-col">
                                <span>TITRE</span>
                            </th>
                            <th class="nk-tb-col">
                                <span>LEÇONS</span>
                            </th>
                            <th class="nk-tb-col">
                                <span>FICHIER</span>
                            </th>
                            <th class="nk-tb-col">
                                <span>ACTION</span>
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($resources as $resource)
                            <tr class="nk-tb-item text-center">
                                <td class="nk-tb-col">
                                    <span class="tb-lead">{{ $resource->id ?? "" }}</span>
                                </td>
                                <td class="nk-tb-col">
                                    <span class="tb-lead">{{ ucfirst($resource->name) }}</span>
                                </td>
                                <td class="nk-tb-col">
                                    <span class="tb-lead">
                                        {{ ucfirst($resource->lesson->name) ?? 0 }}
                                    </span>
                                </td>
                                <td class="nk-tb-col">
                                    <span class="tb-lead">
                                        <a class="btn btn-dim btn-sm btn-danger" href="{{ asset('storage/'. $resource->path) }}" download>
                                            Telecharger
                                            <em class="icon ni ni-download"></em>
                                        </a>
                                    </span>
                                </td>
                                <td class="nk-tb-col">
                                        <span class="tb-lead">
                                            <div class="d-flex justify-content-center">
                                                @can('resource-read')
                                                <a href="{{ route('admins.academic.resource.show', $resource->id) }}" class="btn btn-dim btn-primary btn-sm ml-1">
                                                    <em class="icon ni ni-eye"></em>
                                                </a>
                                                @endcan
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

