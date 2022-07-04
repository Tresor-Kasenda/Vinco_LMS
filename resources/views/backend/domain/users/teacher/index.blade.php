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
                                        <li class="nk-block-tools-opt">
                                            <a class="btn btn-dim btn-primary btn-sm"
                                               href="{{ route('admins.users.teacher.create') }}">
                                                <em class="icon ni ni-plus"></em>
                                                <span>Create</span>
                                            </a>
                                        </li>
                                        <li class="nk-block-tools-opt">
                                            <a class="btn btn-dim btn-secondary btn-sm"
                                               href="{{ route('admins.teacher.history') }}">
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
                        <tr class="nk-tb-item nk-tb-head text-center">
                            <th class="nk-tb-col tb-col-sm">
                                <span>IMAGES</span>
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
                                <span>MATRICULE</span>
                            </th>
                            <th class="nk-tb-col tb-col-md">
                                <span>ACTION</span>
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($teachers as $teacher)
                            <tr class="nk-tb-item text-center">
                                <td class="nk-tb-col tb-col-sm">
                                    <span class="tb-product">
                                        <img
                                            src="{{ asset('storage/'. $teacher->images) }}"
                                            alt="{{ $teacher->firstName }}"
                                            class="thumb">
                                    </span>
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
                                    <span class="tb-lead">{{ $teacher->matriculate ?? "" }}</span>
                                </td>
                                <td class="nk-tb-col">
                                    <span class="tb-lead">
                                        <div class="d-flex justify-content-center">
                                            <a href="{{ route('admins.users.teacher.show', $teacher->id) }}"
                                               class="btn btn-dim btn-primary btn-sm ml-1">
                                                <em class="icon ni ni-eye-alt"></em>
                                            </a>
                                            <a href="{{ route('admins.users.teacher.edit', $teacher->id) }}"
                                               class="btn btn-dim btn-primary btn-sm ml-1">
                                                <em class="icon ni ni-edit-alt"></em>
                                            </a>
                                            <form action="{{ route('admins.users.teacher.destroy', $teacher->id) }}"
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
