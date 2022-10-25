@extends('backend.layout.base')

@section('title')
    Student List
@endsection

@section('content')
    <div class="container-fluid">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="nk-block-head nk-block-head-sm">
                    <div class="nk-block-between">
                        <div class="nk-block-head-content">
                            <h3 class="nk-block-title page-title">Student List</h3>
                        </div>
                        <div class="nk-block-head-content">
                            <div class="toggle-wrap nk-block-tools-toggle">
                                <div class="toggle-expand-content" data-content="more-options">
                                    <ul class="nk-block-tools g-3">
                                        @can('student-create')
                                            <li class="nk-block-tools-opt">
                                                <a class="btn btn-outline-primary btn-sm" href="{{ $viewModel->indexUrl }}">
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
                                <span>MATRICULE</span>
                            </th>
                            <th class="nk-tb-col">
                                <span>NOM</span>
                            </th>
                            <th class="nk-tb-col tb-col-md">
                                <span>EMAIL</span>
                            </th>
                            <th class="nk-tb-col tb-col-md">
                                <span>INSTITUTION</span>
                            </th>
                            <th class="nk-tb-col text-center">
                                <span>ACTIONS</span>
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($viewModel->students() as $student)
                            <tr class="nk-tb-item text-center">
                                <td class="nk-tb-col">
                                    <span class="tb-lead">{{ $student->id ?? "" }}</span>
                                </td>
                                <td class="nk-tb-col tb-col-sm">
                                    <span class="tb-product justify-content-center">
                                        <img
                                            src="{{ $student->getImages() }}"
                                            alt="{{ $student->name }}"
                                            class="thumb">
                                    </span>
                                </td>
                                <td class="nk-tb-col">
                                    <span class="tb-lead">{{ $student->matriculate ?? "" }}</span>
                                </td>
                                <td class="nk-tb-col">
                                    <span class="tb-lead">{{ ucfirst($student->name) ?? "" }}</span>
                                </td>
                                <td class="nk-tb-col">
                                    <span class="tb-lead">{{ $student->email ?? "" }}</span>
                                </td>
                                <td class="nk-tb-col">
                                    <span class="tb-lead">
                                        {{ ucfirst($student->user->institution->institution_name) ?? "" }}
                                    </span>
                                </td>
                                <td class="nk-tb-col">
                                    @can('student-read')
                                        <div class="tb-lead justify-content-center">
                                            <a href="{{ route('admins.users.student.show', $student->id) }}"
                                               class="btn btn-outline-primary btn-sm" title="">
                                                <em class="icon ni ni-eye-alt-fill"></em>
                                                <span>Detail etudiant</span>
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
