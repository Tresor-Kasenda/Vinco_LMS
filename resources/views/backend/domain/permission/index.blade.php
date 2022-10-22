@extends('backend.layout.base')

@section('title')
    Administration des permissions
@endsection

@section('content')
    <div class="container-fluid">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="nk-block-head nk-block-head-sm">
                    <div class="nk-block-between">
                        <div class="nk-block-head-content">
                            <h3 class="nk-block-title page-title">Permissions</h3>
                        </div>
                        <div class="nk-block-head-content">
                            <div class="toggle-wrap nk-block-tools-toggle">
                                <div class="toggle-expand-content" data-content="more-options">
                                    <ul class="nk-block-tools g-3">
                                        <li class="nk-block-tools-opt">
                                            @role('Super Admin')
                                                <a class="btn btn-outline-primary btn-sm" href="{{ $viewModel->createUrl }}">
                                                    <em class="icon ni ni-plus mr-2"></em>
                                                    <span>Ajouter un permission</span>
                                                </a>
                                            @endrole
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="nk-block nk-block-lg">
                    <table class="datatable-init nowrap nk-tb-list is-separate" data-auto-responsive="false">
                        <thead>
                        <tr class="nk-tb-item nk-tb-head">
                            <th class="nk-tb-col tb-col-sm">
                                <span>ID</span>
                            </th>
                            <th class="nk-tb-col tb-col-sm">
                                <span>NAME</span>
                            </th>
                            <th class="nk-tb-col text-center">
                                <span>ACTIONS</span>
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($viewModel->permissions() as $permission)
                            <tr class="nk-tb-item text-center">
                                <td class="nk-tb-col">
                                    <span class="tb-lead">
                                        {{ $permission->id ?? "" }}
                                    </span>
                                </td>
                                <td class="nk-tb-col">
                                    <span class="tb-lead">
                                        {{ ucfirst($permission->name) ?? "" }}
                                    </span>
                                </td>
                                <td class="nk-tb-col text-center">
                                    <span class="tb-lead">
                                        <div class="d-flex justify-content-center">
                                            <a href="{{ route('admins.permissions.edit', $permission->id) }}" class="btn btn-dim btn-primary btn-sm ml-1">
                                                <em class="icon ni ni-edit"></em>
                                            </a>
                                            <form action="{{ route('admins.permissions.destroy', $permission->id) }}" method="POST" onsubmit="return confirm('Voulez vous supprimer');">
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
