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
                                        <li class="nk-block-tools-opt">
                                            <a class="btn btn-dim btn-primary btn-sm"
                                               href="{{ route('admins.users.student.create') }}">
                                                <em class="icon ni ni-plus"></em>
                                                <span>Create</span>
                                            </a>
                                        </li>
                                        @role('Super Admin')
                                        <li class="nk-block-tools-opt">
                                            <a class="btn btn-dim btn-secondary btn-sm"
                                               href="{{ route('admins.administrator.history') }}">
                                                <em class="icon ni ni-histroy"></em>
                                                <span>Corbeille</span>
                                            </a>
                                        </li>
                                        @endrole
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
                                <span>MATRICULE</span>
                            </th>
                            <th class="nk-tb-col">
                                <span>NOM</span>
                            </th>
                            <th class="nk-tb-col tb-col-md">
                                <span>EMAIL</span>
                            </th>
                            <th class="nk-tb-col tb-col-md">
                                <span>DEPARTEMENT</span>
                            </th>
                            <th class="nk-tb-col text-center">
                                <span>ACTIONS</span>
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($students as $student)
                            <tr class="nk-tb-item text-center">
                                <td class="nk-tb-col">
                                    <span class="tb-lead">
                                        <span class="tb-lead">
                                            <img
                                                src="{{ $student->getImages() }}"
                                                alt="{{ $student->name }}"
                                                class="img-fluid rounded-circle"
                                                width="10%"
                                                height="10%"
                                            >
                                        </span>
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
                                    <span class="tb-lead">{{ ucfirst($student->department->name) ?? "" }}</span>
                                </td>
                                <td class="nk-tb-col">
                                    <span class="tb-lead">
                                            <div class="d-flex justify-content-center">
                                                <a href="{{ route('admins.users.student.show', $student->id) }}"
                                                   class="btn btn-dim btn-primary btn-sm ml-1">
                                                    <em class="icon ni ni-eye"></em>
                                                </a>
                                                <a href="{{ route('admins.users.student.edit', $student->id) }}"
                                                   class="btn btn-dim btn-primary btn-sm ml-1">
                                                    <em class="icon ni ni-edit"></em>
                                                </a>
                                                <form action="{{ route('admins.users.student.destroy', $student->id) }}"
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
