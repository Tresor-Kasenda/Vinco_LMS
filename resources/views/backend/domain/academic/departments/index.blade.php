@extends('backend.layout.base')

@section('title')
    Department Lists
@endsection

@section('content')
    <div class="container-fluid">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="nk-block-head nk-block-head-sm">
                    <div class="nk-block-between">
                        <div class="nk-block-head-content">
                            <h3 class="nk-block-title page-title">Department Lists</h3>
                        </div>
                        <div class="nk-block-head-content">
                            <div class="toggle-wrap nk-block-tools-toggle">
                                <div class="toggle-expand-content" data-content="more-options">
                                    <ul class="nk-block-tools g-3">
                                        <li class="nk-block-tools-opt">
                                            <a class="btn btn-dim btn-primary btn-sm" href="{{ route('admins.academic.departments.create') }}">
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
                                    <span>IMAGES</span>
                                </th>
                                <th class="nk-tb-col">
                                    <span>NOM</span>
                                </th>
                                <th class="nk-tb-col">
                                    <span>NOM DU CAMPUS</span>
                                </th>
                                <th class="nk-tb-col">
                                    <span>RESPONSABLE</span>
                                </th>
                                <th class="nk-tb-col nk-tb-col-tools">
                                    <span>ACTIONS</span>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($departments as $department)
                                <tr class="nk-tb-item text-center">
                                    <td class="nk-tb-col">
                                        <span class="tb-product">
                                            <img
                                                src="{{ asset('storage/'. $department->images) }}"
                                                alt="{{ $department->name }}"
                                                class="thumb">
                                        </span>
                                    </td>
                                    <td class="nk-tb-col">
                                        <span class="tb-lead">{{ ucfirst($department->name) ?? "" }}</span>
                                    </td>
                                    <td class="nk-tb-col">
                                        <span class="tb-lead">{{ ucfirst($department->campus->name) ?? "" }}</span>
                                    </td>
                                    <td class="nk-tb-col">
                                        @foreach($department->users as $user)
                                            <span class="tb-lead">{{ ucfirst($user->name) }}</span>
                                        @endforeach
                                    </td>
                                    <td class="nk-tb-col">
                                        <span class="tb-lead">
                                            <div class="d-flex justify-content-center">
                                                <a href="{{ route('admins.academic.departments.show', $department->id) }}"
                                                   class="btn btn-dim btn-primary btn-sm ml-1">
                                                    <em class="icon ni ni-eye-alt"></em>
                                                </a>
                                                <a href="{{ route('admins.academic.departments.edit', $department->id) }}"
                                                   class="btn btn-dim btn-primary btn-sm ml-1">
                                                    <em class="icon ni ni-edit-alt"></em>
                                                </a>
                                                <form action="{{ route('admins.academic.departments.destroy', $department->id) }}"
                                                      method="POST" onsubmit="return confirm('Voulez vous supprimer');">
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
