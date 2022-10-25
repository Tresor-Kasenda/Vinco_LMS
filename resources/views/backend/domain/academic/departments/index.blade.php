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
                                        @can('department-create')
                                            <li class="nk-block-tools-opt">
                                                <a class="btn btn-outline-primary btn-sm" href="{{ $viewModel->createUrl }}">
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
                                <th class="nk-tb-col">
                                    <span>ID</span>
                                </th>
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
                                @if(auth()->user()->hasRole('Super Admin'))
                                    <th class="nk-tb-col">
                                        <span>INSTITUTION</span>
                                    </th>
                                @endif
                                <th class="nk-tb-col nk-tb-col-tools">
                                    <span>ACTIONS</span>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($viewModel->departments() as $department)
                                <tr class="nk-tb-item text-center">
                                    <td class="nk-tb-col">
                                        <span class="tb-lead">
                                            {{ $department->id ?? "" }}
                                        </span>
                                    </td>
                                    <td class="nk-tb-col">
                                        <span class="tb-product">
                                            <img
                                                src="{{ asset('storage/'. $department->images) }}"
                                                alt="{{ $department->name }}"
                                                class="thumb">
                                        </span>
                                    </td>
                                    <td class="nk-tb-col">
                                        <span class="tb-lead">
                                            {{ ucfirst($department->name) ?? "" }}
                                        </span>
                                    </td>
                                    <td class="nk-tb-col">
                                        <span class="tb-lead">
                                            {{ ucfirst($department->campus->name) ?? "" }}
                                        </span>
                                    </td>
                                    <td class="nk-tb-col">
                                        @foreach($department->users as $user)
                                            <span class="tb-lead">{{ ucfirst($user->name) }}</span>
                                        @endforeach
                                    </td>
                                    @if(auth()->user()->hasRole('Super Admin'))
                                        <th class="nk-tb-col">
                                            <span class="tb-lead">{{ ucfirst($department->campus->institution->institution_name) ?? "" }}</span>
                                        </th>
                                    @endif
                                    <td class="nk-tb-col">
                                        @can('department-view')
                                            <div class="tb-lead justify-content-center">
                                                <a href="{{ route('admins.academic.departments.show', $department->id) }}"
                                                   class="btn btn-outline-primary btn-sm" title="">
                                                    <em class="icon ni ni-eye-alt-fill"></em>
                                                    <span>Detail Departement</span>
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
