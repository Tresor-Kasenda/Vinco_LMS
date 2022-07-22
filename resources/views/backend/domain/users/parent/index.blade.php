@extends('backend.layout.base')

@section('title')
    Parent List
@endsection

@section('content')
    <div class="container-fluid">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="nk-block-head nk-block-head-sm">
                    <div class="nk-block-between">
                        <div class="nk-block-head-content">
                            <h3 class="nk-block-title page-title">Parent List</h3>
                        </div>
                        <div class="nk-block-head-content">
                            <div class="toggle-wrap nk-block-tools-toggle">
                                <div class="toggle-expand-content" data-content="more-options">
                                    <ul class="nk-block-tools g-3">
                                        @permission('parent-create')
                                            <li class="nk-block-tools-opt">
                                                <a class="btn btn-dim btn-primary btn-sm" href="{{ route('admins.users.guardian.create') }}">
                                                    <em class="icon ni ni-plus"></em>
                                                    <span>Create</span>
                                                </a>
                                            </li>
                                            <li class="nk-block-tools-opt">
                                                <a class="btn btn-dim btn-secondary btn-sm" href="{{ route('admins.administrator.history') }}">
                                                    <em class="icon ni ni-histroy"></em>
                                                    <span>Corbeille</span>
                                                </a>
                                            </li>
                                        @endpermission
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
                                <span>EMAIL</span>
                            </th>
                            <th class="nk-tb-col tb-col-md">
                                <span>PHONES</span>
                            </th>
                            <th class="nk-tb-col tb-col-md">
                                <span>STATUS</span>
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($parents as $parent)
                            <tr class="nk-tb-item text-center">
                                <td class="nk-tb-col">
                                    <span class="tb-lead">
                                        <img
                                            src="{{ asset('storage/'.$parent->images) }}"
                                            alt="{{ $parent->name_guardian }}"
                                            class="img-fluid rounded-circle"
                                            width="15%"
                                            height="15%"
                                        >
                                    </span>
                                </td>
                                <td class="nk-tb-col">
                                    <span class="tb-lead">{{ ucfirst($parent->name_guardian) ?? "" }}</span>
                                </td>
                                <td class="nk-tb-col">
                                    <span class="tb-lead">{{ $parent->email_guardian ?? "" }}</span>
                                </td>
                                <td class="nk-tb-col">
                                    <div class="tb-lead d-flex flex-wrap">
                                        <span class="tb-lead">{{ $parent->phones ?? "" }}</span>
                                    </div>
                                </td>

                                <td class="nk-tb-col">
                                    <span class="tb-lead">
                                        <div class="d-flex justify-content-center">
                                            <a href="{{ route('admins.users.guardian.show', $parent->id) }}" class="btn btn-dim btn-primary btn-sm ml-1">
                                                <em class="icon ni ni-eye-alt"></em>
                                            </a>
                                            @permission('parent-update')
                                                <a href="{{ route('admins.users.guardian.edit', $parent->id) }}" class="btn btn-dim btn-primary btn-sm ml-1">
                                                    <em class="icon ni ni-edit-alt"></em>
                                                </a>
                                            @endpermission

                                            @permission('parent-delete')
                                                <form action="{{ route('admins.users.guardian.destroy', $parent->id) }}" method="POST" onsubmit="return confirm('Voulez vous supprimer');">
                                                    @method('DELETE')
                                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                    <button type="submit" class="btn btn-dim btn-danger btn-sm">
                                                        <em class="icon ni ni-trash"></em>
                                                    </button>
                                                </form>
                                            @endpermission
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
