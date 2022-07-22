@extends('backend.layout.base')

@section('title')
    Institutions
@endsection

@section('content')
    <div class="container-fluid">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="nk-block-head nk-block-head-sm">
                    <div class="nk-block-between">
                        <div class="nk-block-head-content">
                            <h3 class="nk-block-title page-title">Institution Listen</h3>
                        </div>
                        <div class="nk-block-head-content">
                            <div class="toggle-wrap nk-block-tools-toggle">
                                <div class="toggle-expand-content" data-content="more-options">
                                    <ul class="nk-block-tools g-3">
                                        @permission('institution-create')
                                            <li class="nk-block-tools-opt">
                                                <a class="btn btn-dim btn-primary btn-sm" href="{{ route('admins.institution.create') }}">
                                                    <em class="icon ni ni-plus"></em>
                                                    <span>Create</span>
                                                </a>
                                            </li>
                                        @endpermission
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="nk-block nk-block-lg">
                    <table class="datatable-init nowrap nk-tb-list is-separate" data-auto-responsive="false">
                        <thead>
                        <tr class="nk-tb-item nk-tb-head">
                            <th class="nk-tb-col tb-col-sm">
                                <span>IMAGES</span>
                            </th>
                            <th class="nk-tb-col tb-col-sm">
                                <span>NOM</span>
                            </th>
                            <th class="nk-tb-col text-center">
                                <span>VILLE</span>
                            </th>
                            <th class="nk-tb-col text-center">
                                <span>ADDRESS</span>
                            </th>
                            <th class="nk-tb-col text-center">
                                <span>RESPONSABLE</span>
                            </th>
                            <th class="nk-tb-col text-center">
                                <span>ACTIONS</span>
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($institutions as $institution)
                            <tr class="nk-tb-item">
                                <td class="nk-tb-col">
                                    <span class="tb-lead">
                                        <img
                                            src="{{ asset('storage/'.$institution->institution_images) }}"
                                            alt="{{ $institution->institution_name }}"
                                            class="img-fluid rounded-circle"
                                            width="10%"
                                            height="10%"
                                        >
                                    </span>
                                </td>
                                <td class="nk-tb-col">
                                    <span class="tb-lead">
                                        {{ ucfirst($institution->institution_name) }}
                                    </span>
                                </td>
                                <td class="nk-tb-col">
                                    <span class="tb-lead">
                                        {{ $institution->institution_town }}
                                    </span>
                                </td>
                                <td class="nk-tb-col">
                                    <span class="tb-lead">
                                        {{ $institution->institution_address }}
                                    </span>
                                </td>
                                @if($institution->user != null)
                                    <td class="nk-tb-col">
                                        <span class="tb-lead">
                                            {{ ucfirst($institution->user->name) }}
                                        </span>
                                    </td>
                                @else
                                    <td class="nk-tb-col">
                                        <span class="tb-lead">
                                            Pas de gestionnaire
                                        </span>
                                    </td>
                                @endif
                                <td class="nk-tb-col text-center">
                                    <span class="tb-lead text-center">
                                        <div class="d-flex">
                                            @permission('institution-read')
                                                <a href="{{ route('admins.institution.show', $institution->id) }}" class="btn btn-dim btn-primary btn-sm ml-1">
                                                    <em class="icon ni ni-eye"></em>
                                                </a>
                                            @endpermission
                                            @permission('institution-update')
                                                <a href="{{ route('admins.institution.edit', $institution->id) }}" class="btn btn-dim btn-primary btn-sm ml-1">
                                                    <em class="icon ni ni-edit"></em>
                                                </a>
                                            @endpermission
                                            @permission('institution-delete')
                                                <form action="{{ route('admins.institution.destroy', $institution->id) }}" method="POST" onsubmit="return confirm('Voulez vous supprimer');">
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
