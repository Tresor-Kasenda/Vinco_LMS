@extends('backend.layout.base')

@section('title', "Administration")

@section('content')
    <div class="container-fluid">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="nk-block-head nk-block-head-sm">
                    <div class="nk-block-between">
                        <div class="nk-block-head-content">
                            <h3 class="nk-block-title page-title">Campus</h3>
                        </div>
                        <div class="nk-block-head-content">
                            <div class="toggle-wrap nk-block-tools-toggle">
                                <div class="toggle-expand-content" data-content="more-options">
                                    <ul class="nk-block-tools g-3">
                                        <li class="nk-block-tools-opt">
                                            <a class="btn btn-dim btn-primary btn-sm" href="{{ route('admins.campus.create') }}">
                                                <em class="icon ni ni-plus"></em>
                                                <span>Add</span>
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
                            <tr class="nk-tb-item nk-tb-head">
                                <th class="nk-tb-col tb-col-sm">
                                    <span>Image</span>
                                </th>
                                <th class="nk-tb-col">
                                    <span>Dirigeant</span>
                                </th>
                                <th class="nk-tb-col">
                                    <span>Status</span>
                                </th>
                                <th class="nk-tb-col nk-tb-col-tools">
                                    <ul class="nk-tb-actions gx-1 my-n1">
                                        <li class="me-n1">
                                            <div>
                                                <a href="#" class="btn btn-icon btn-trigger">
                                                    <em class="icon ni ni-more-h"></em>
                                                </a>
                                            </div>
                                        </li>
                                    </ul>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($campuses as $campus)
                                <tr class="nk-tb-item">
                                    <td class="nk-tb-col tb-col-sm">
                                    <span class="tb-product">
                                        <img
                                            src="{{ asset('storage/'. $campus->images) }}"
                                            alt="{{ $campus->name }}"
                                            class="thumb">
                                    </span>
                                    </td>
                                    <td class="nk-tb-col">
                                        <span class="tb-sub">{{ $campus->name }}</span>
                                    </td>
                                    <td class="nk-tb-col">
                                        <span class="tb-sub">{{ strtoupper($campus->user->name) }}-{{ strtoupper($campus->user->firstname) }}</span>
                                    </td>
                                    <td class="nk-tb-col tb-col-md">
                                        @if($campus->status)
                                            <span class="dot bg-success d-mb-none"></span>
                                            <span class="badge badge-sm badge-dot has-bg badge-success d-none d-mb-inline-flex">Confirmer</span>
                                        @else
                                            <span class="dot bg-warning d-mb-none"></span>
                                            <span class="badge badge-sm badge-dot has-bg badge-warning d-none d-mb-inline-flex">En attente</span>
                                        @endif
                                    </td>
                                    <td class="nk-tb-col nk-tb-col-tools">
                                        <ul class="nk-tb-actions gx-1 my-n1">
                                            <li class="me-n1">
                                                <div class="dropdown">
                                                    <a href="#" class="dropdown-toggle btn btn-icon btn-trigger" data-bs-toggle="dropdown">
                                                        <em class="icon ni ni-more-h"></em>
                                                    </a>
                                                    <div class="dropdown-menu dropdown-menu-end">
                                                        <ul class="link-list-opt no-bdr">
                                                            <li>
                                                                <a href="{{ route('admins.campus.edit', $campus->id) }}">
                                                                    <em class="icon ni ni-edit"></em>
                                                                    <span>Edit</span>
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <a href="{{ route('admins.campus.show', $campus->id) }}">
                                                                    <em class="icon ni ni-eye"></em>
                                                                    <span>View</span>
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <form action="{{ route('admins.campus.destroy', $professor->id) }}" method="POST" onsubmit="return confirm('Voulez vous supprimer');">
                                                                    @method('DELETE')
                                                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                                    <button type="submit" class="btn btn-dim">
                                                                        <em class="icon ni ni-trash"></em>
                                                                        <span>Remove</span>
                                                                    </button>
                                                                </form>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
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
