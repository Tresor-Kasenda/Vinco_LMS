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
                                        @can('institution-create')
                                            <li class="nk-block-tools-opt">
                                                <a class="btn btn-dim btn-primary btn-sm" href="{{ route('admins.institution.create') }}">
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
                            <tr class="nk-tb-item text-center">
                                <td class="nk-tb-col">
                                    <span class="tb-lead">
                                        <img
                                            src="{{ asset('storage/'.$institution->institution_images) }}"
                                            alt="{{ $institution->institution_name }}"
                                            class="img-fluid rounded-circle"
                                            width="15%"
                                            height="15%"
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
                                            {{ ucfirst($institution->user->name) ?? "" }}
                                        </span>
                                    </td>
                                @else
                                    <td class="nk-tb-col">
                                        <span class="tb-lead">
                                            Not Exist
                                        </span>
                                    </td>
                                @endif
                                <td class="nk-tb-col">
                                    @can('institution-read')
                                    <div class="tb-lead justify-content-center">
                                        <a href="{{ route('admins.institution.show', $institution->id) }}"
                                           class="btn btn-dim btn-primary btn-sm" title="">
                                            <em class="icon ni ni-eye-alt-fill"></em>
                                            <span>Detail seminar</span>
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
