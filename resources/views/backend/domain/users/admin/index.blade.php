@extends('backend.layout.base')

@section('title')
    Admins Lists
@endsection

@section('content')
    <div class="container-fluid">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="nk-block-head nk-block-head-sm">
                    <div class="nk-block-between">
                        <div class="nk-block-head-content">
                            <h3 class="nk-block-title page-title">Admins List</h3>
                        </div>
                        <div class="nk-block-head-content">
                            <div class="toggle-wrap nk-block-tools-toggle">
                                <div class="toggle-expand-content">
                                    <ul class="nk-block-tools g-3">
                                        @can('admin-create')
                                            <li class="nk-block-tools-opt">
                                                <a class="btn btn-dim btn-primary btn-sm" href="{{ route('admins.users.admin.create') }}">
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
                                    <span>name</span>
                                </th>
                                <th class="nk-tb-col">
                                    <span>Email</span>
                                </th>
                                <th class="nk-tb-col tb-col-md">
                                    <span>Status</span>
                                </th>
                                <th class="nk-tb-col tb-col-md">
                                    <span>Role</span>
                                </th>
                                <th class="nk-tb-col tb-col-md">
                                    <span>Institution</span>
                                </th>
                                <th class="nk-tb-col tb-col-md">
                                    <span>ACTIONS</span>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($admins as $administrator)
                                <tr class="nk-tb-item text-center">
                                    <td class="nk-tb-col">
                                        <span class="tb-lead">{{ ucfirst($administrator->name) ?? "" }}</span>
                                    </td>
                                    <td class="nk-tb-col">
                                        <span class="tb-lead">{{ $administrator->email ?? "" }}</span>
                                    </td>
                                    <td class="nk-tb-col">
                                        @if($administrator->status)
                                            <span class="dot bg-success d-sm-none"></span>
                                            <span class="badge badge-sm badge-dot has-bg bg-success d-none d-sm-inline-flex">Confirmer</span>
                                        @else
                                            <span class="dot bg-warning d-sm-none"></span>
                                            <span class="badge badge-sm badge-dot has-bg bg-warning d-none d-sm-inline-flex">En attente</span>
                                        @endif
                                    </td>
                                    <td class="nk-tb-col">
                                        <div class="tb-lead d-flex flex-wrap justify-content-center">
                                            @foreach($administrator->roles as $role)
                                                <span class="badge bg-primary mx-1 mb-1">{{$role->name ?? "" }}</span>
                                            @endforeach
                                        </div>
                                    </td>
                                    <td class="nk-tb-col">
                                        <span class="tb-lead">{{ ucfirst($administrator->institution->institution_name) ?? "" }}</span>
                                    </td>
                                    <td class="nk-tb-col">
                                        <span class="tb-lead">
                                            <div class="d-flex justify-content-center">
                                                @can('admin-read')
                                                <a href="{{ route('admins.users.admin.show', $administrator->id) }}" class="btn btn-dim btn-primary btn-sm ml-1">
                                                    <em class="icon ni ni-eye-alt"></em>
                                                </a>
                                                @endcan
                                                @can('admin-update')
                                                <a href="{{ route('admins.users.admin.edit', $administrator->id) }}" class="btn btn-dim btn-primary btn-sm ml-1">
                                                    <em class="icon ni ni-edit-alt"></em>
                                                </a>
                                                @endcan

                                                @can('admin-delete')
                                                <form action="{{ route('admins.users.admin.destroy', $administrator->id) }}" method="POST" onsubmit="return confirm('Voulez vous supprimer');">
                                                    @method('DELETE')
                                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                    <button type="submit" class="btn btn-dim btn-danger btn-sm">
                                                        <em class="icon ni ni-trash"></em>
                                                    </button>
                                                </form>
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
