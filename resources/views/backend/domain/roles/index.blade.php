@extends('backend.layout.base')

@section('title', "Tableau de bord")

@section('content')
    <div class="container-fluid">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="nk-block-head">
                    <div class="nk-block-head-content">
                        <h6 class="nk-block-title page-title h5">Role List</h6>
                    </div>
                </div>
                <div class="nk-block nk-block-lg">
                    <table class="datatable-init nowrap nk-tb-list is-separate" data-auto-responsive="false">
                        <thead>
                        <tr class="nk-tb-item nk-tb-head">
                            <th class="nk-tb-col tb-col-sm">
                                <span>ROLE</span>
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
                                    <span class="tb-lead">{{ ucfirst($role->title) ?? "" }}</span>
                                </td>
                                <td class="nk-tb-col text-center">
                                    <span class="tb-lead text-center">
                                        <div class="d-flex">
                                            <a href="{{ route('admins.roles.edit', $role->id) }}" class="btn btn-dim btn-primary btn-sm ml-1">
                                                <em class="icon ni ni-edit"></em>
                                            </a>
                                            @if(auth()->user()->role_id == 6)
                                                <form action="{{ route('admins.roles.destroy', $role->id) }}" method="POST" onsubmit="return confirm('Voulez vous supprimer');">
                                                    @method('DELETE')
                                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                    <button type="submit" class="btn btn-dim btn-danger btn-sm">
                                                        <em class="icon ni ni-trash"></em>
                                                    </button>
                                                </form>
                                            @endif
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
