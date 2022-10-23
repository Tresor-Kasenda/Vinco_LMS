@extends('backend.layout.base')

@section('title')
    Professors Lists
@endsection

@section('content')
    <div class="container-fluid">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="nk-block-head nk-block-head-sm">
                    <div class="nk-block-between">
                        <div class="nk-block-head-content">
                            <h3 class="nk-block-title page-title">Liste des professeurs</h3>
                        </div>
                        <div class="nk-block-head-content">
                            <div class="toggle-wrap nk-block-tools-toggle">
                                <div class="toggle-expand-content" data-content="more-options">
                                    <ul class="nk-block-tools g-3">
                                        @can('professor-create')
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
                            <th class="nk-tb-col tb-col-sm">
                                <span>ID</span>
                            </th>
                            <th class="nk-tb-col tb-col-sm">
                                <span>IMAGES</span>
                            </th>
                            <th class="nk-tb-col">
                                <span>MATRICULE</span>
                            </th>
                            <th class="nk-tb-col">
                                <span>NOM</span>
                            </th>
                            <th class="nk-tb-col">
                                <span>EMAIL</span>
                            </th>
                            <th class="nk-tb-col">
                                <span>Phones</span>
                            </th>
                            <th class="nk-tb-col">
                                <span>Institution</span>
                            </th>
                            <th class="nk-tb-col tb-col-md">
                                <span>ACTION</span>
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($viewModel->professors() as $teacher)
                            <tr class="nk-tb-item text-center">
                                <td class="nk-tb-col">
                                    <span class="tb-lead">{{ $teacher->id ?? "" }}</span>
                                </td>
                                <td class="nk-tb-col tb-col-sm">
                                    <span class="tb-product">
                                        <img
                                            src="{{ asset('storage/'. $teacher->images) }}"
                                            alt="{{ $teacher->firstName }}"
                                            class="thumb">
                                    </span>
                                </td>
                                <td class="nk-tb-col">
                                    <span class="tb-lead">{{ $teacher->matriculate ?? "" }}</span>
                                </td>
                                <td class="nk-tb-col">
                                    <span class="tb-lead">{{ ucfirst($teacher->username) ?? "" }}</span>
                                </td>
                                <td class="nk-tb-col">
                                    <span class="tb-lead">{{ $teacher->email ?? "" }}</span>
                                </td>
                                <td class="nk-tb-col">
                                    <span class="tb-lead">{{ $teacher->phones ?? "" }}</span>
                                </td>

                                <td class="nk-tb-col">
                                    @if($teacher->user->institution_id != null)
                                        <span class="tb-lead">{{ $teacher->user->institution->institution_name ?? "" }}</span>
                                    @else
                                        <span class="tb-lead">Pas d'institution</span>
                                    @endif
                                </td>
                                <td class="nk-tb-col">
                                    @can('professor-view')
                                        <div class="tb-lead justify-content-center">
                                            <a href="{{ route('admins.users.teacher.show', $teacher->id) }}"
                                               class="btn btn-outline-primary btn-sm" title="">
                                                <em class="icon ni ni-eye-alt-fill"></em>
                                                <span>Detail Professeur</span>
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
