@extends('backend.layout.base')

@section('title')
    Personnels Lists
@endsection

@section('content')
    <div class="container-fluid">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="nk-block-head nk-block-head-sm">
                    <div class="nk-block-between">
                        <div class="nk-block-head-content">
                            <h3 class="nk-block-title page-title">Liste des personnels</h3>
                        </div>
                        <div class="nk-block-head-content">
                            <div class="toggle-wrap nk-block-tools-toggle">
                                <div class="toggle-expand-content" data-content="more-options">
                                    <ul class="nk-block-tools g-3">
                                        <li class="nk-block-tools-opt">
                                            <a class="btn btn-dim btn-primary btn-sm" href="{{ route('admins.users.staffs.create') }}">
                                                <em class="icon ni ni-plus"></em>
                                                <span>Create</span>
                                            </a>
                                        </li>
                                        <li class="nk-block-tools-opt">
                                            <a class="btn btn-dim btn-secondary btn-sm" href="{{ route('admins.personnel.history') }}">
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
                                    <span>Image</span>
                                </th>
                                <th class="nk-tb-col">
                                    <span>name</span>
                                </th>
                                <th class="nk-tb-col">
                                    <span>Email</span>
                                </th>
                                <th class="nk-tb-col">
                                    <span>Phones</span>
                                </th>
                                <th class="nk-tb-col">
                                    <span>Matricule</span>
                                </th>
                                <th class="nk-tb-col tb-col-md">
                                    <span>ACTIONS</span>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($employees as $personnel)
                                <tr class="nk-tb-item text-center">
                                    <td class="nk-tb-col tb-col-sm">
                                    <span class="tb-product justify-content-center">
                                        <img
                                            src="{{ asset('storage/'. $personnel->images_personnel) }}"
                                            alt="{{ $personnel->firstName }}"
                                            class="thumb">
                                    </span>
                                    </td>
                                    <td class="nk-tb-col">
                                        <span class="tb-lead">{{ ucfirst($personnel->username) ?? "" }}</span>
                                    </td>
                                    <td class="nk-tb-col">
                                        <span class="tb-lead">{{ $personnel->email ?? "" }}</span>
                                    </td>
                                    <td class="nk-tb-col">
                                        <span class="tb-lead">{{ $personnel->phones ?? "" }}</span>
                                    </td>
                                    <td class="nk-tb-col">
                                        <span class="tb-lead">{{ $personnel->matriculate ?? "" }}</span>
                                    </td>
                                    <td class="nk-tb-col">
                                        <span class="tb-lead">
                                            <div class="d-flex justify-content-center">
                                                <a href="{{ route('admins.users.staffs.show', $personnel->id) }}" class="btn btn-dim btn-primary btn-sm ml-1">
                                                    <em class="icon ni ni-eye-alt"></em>
                                                </a>
                                                <a href="{{ route('admins.users.staffs.edit', $personnel->id) }}" class="btn btn-dim btn-primary btn-sm ml-1">
                                                    <em class="icon ni ni-edit-alt"></em>
                                                </a>
                                                <form action="{{ route('admins.users.staffs.destroy', $personnel->id) }}" method="POST" onsubmit="return confirm('Voulez vous supprimer');">
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
