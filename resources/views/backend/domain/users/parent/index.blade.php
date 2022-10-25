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
                                        @can('parent-create')
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
                        <tr class="nk-tb-item nk-tb-head text-center">
                            <th class="nk-tb-col">
                                <span>ID</span>
                            </th>
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
                        @foreach($viewModel->parents() as $parent)
                            <tr class="nk-tb-item text-center">
                                <td class="nk-tb-col">
                                    <span class="tb-lead">{{ $parent->id ?? "" }}</span>
                                </td>
                                <td class="nk-tb-col tb-col-sm">
                                    <span class="tb-product">
                                        <img
                                            src="{{ asset('storage/'. $parent->images) }}"
                                            alt="{{ $parent->name_guardian }}"
                                            class="thumb">
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
                                    @can('parent-view')
                                        <div class="tb-lead justify-content-center">
                                            <a href="{{ route('admins.users.guardian.show', $parent->id) }}"
                                               class="btn btn-outline-primary btn-sm" title="">
                                                <em class="icon ni ni-eye-alt-fill"></em>
                                                <span>Detail Parent</span>
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
