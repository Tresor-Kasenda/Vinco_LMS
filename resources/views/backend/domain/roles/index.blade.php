@extends('backend.layout.base')

@section('title', "Tableau de bord")

@section('content')
    <div class="container-fluid">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="nk-block-head nk-block-head-sm">
                    <div class="nk-block-between">
                        <div class="nk-block-head-content">
                            <h3 class="nk-block-title page-title">Campus</h3>
                        </div>
                        <div class="nk-block-head-content">
                            <div class="toggle-wrap nk-block-tools-toggle">
                                <div class="toggle-expand-content" data-content="more-options">
                                    <ul class="nk-block-tools g-3">
                                        <li class="nk-block-tools-opt">
                                            @role('Super Admin')
                                                <a class="btn btn-dim btn-primary btn-sm" href="{{ route('admins.roles.create') }}">
                                                    <em class="icon ni ni-plus"></em>
                                                    <span>Create</span>
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
                                <span>ROLE</span>
                            </th>
                            <th class="nk-tb-col tb-col-sm">
                                <span>PERMISSION</span>
                            </th>
                            <th class="nk-tb-col text-center">
                                <span>ACTIONS</span>
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($roles as $role)
                            <tr class="nk-tb-item">
                                <td class="nk-tb-col">
                                    <span class="tb-lead">{{ ucfirst($role->name) ?? "" }}</span>
                                </td>
                                <td class="nk-tb-col">
                                    <div class="tb-lead d-flex flex-wrap">
                                        @if($role->permissions)
                                            @foreach($role->permissions as $permission)
                                                <span class="badge bg-primary mx-1 mb-1">
                                                    {{ ucfirst($permission->name) }}
                                                </span>
                                            @endforeach
                                        @endif
                                    </div>
                                </td>
                                <td class="nk-tb-col text-center">
                                    <span class="tb-lead text-center">
                                        <div class="d-flex">
                                            @can('role-edit')
                                            <a href="{{ route('admins.roles.edit', $role->id) }}" class="btn btn-dim btn-primary btn-sm ml-1">
                                                <em class="icon ni ni-edit"></em>
                                            </a>
                                            @endcan

                                            @can('role-delete')
                                                @role('Super Admin')
                                                <form action="{{ route('admins.roles.destroy', $role->id) }}" method="POST" onsubmit="return confirm('Voulez vous supprimer');">
                                                    @method('DELETE')
                                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                    <button type="submit" class="btn btn-dim btn-danger btn-sm">
                                                        <em class="icon ni ni-trash"></em>
                                                    </button>
                                                </form>
                                                @endrole
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
