@extends('backend.layout.base')

@section('title')
    Show Institution
@endsection

@section('content')
    <div class="container-fluid">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="nk-block-head nk-block-head-sm">
                    <div class="nk-block-between">
                        <div class="nk-block-head-content">
                            <h6 class="nk-block-title page-title">
                                Show Institution
                            </h6>
                        </div>
                        <div class="nk-block-head-content">
                            <div class="toggle-wrap nk-block-tools-toggle">
                                <div class="toggle-expand-content" data-content="more-options">
                                    <ul class="nk-block-tools g-3">
                                        <li class="nk-block-tools-opt">
                                            <a class="btn btn-dim btn-primary btn-sm"
                                               href="{{ route('admins.institution.index') }}">
                                                <em class="icon ni ni-arrow-left"></em>
                                                <span>Back</span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="nk-block">
                    <div class="row justify-content-center">
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-body border-bottom py-3">
                                    <div class="text-center">
                                        <img
                                            @if($institution->institution_images)
                                                src="{{ asset('storage/'.$institution->institution_images) }}"
                                            @else
                                                src="{{ asset('assets/admins/images/man.webp') }}"
                                            @endif
                                            title="{{ $institution->institution_name }}"
                                            style="object-fit: contain"
                                            class="img-fluid user-avatar-xl mb-3 text-center rounded-circle border-danger"
                                        >
                                    </div>
                                    <table class="table">
                                        <tbody>
                                        <tr>
                                            <th>Name Institution</th>
                                            <td>{{ strtoupper($institution->institution_name) ?? "" }}</td>
                                        </tr>
                                        <tr>
                                            <th>Responsable</th>
                                            <td>{{ strtoupper($institution->user->name) ?? "" }}</td>
                                        </tr>

                                        <tr>
                                            <th>Pays</th>
                                            <td>
                                                {{ $institution->institution_country ?? "" }}
                                            </td>
                                        </tr>

                                        <tr>
                                            <th>Ville</th>
                                            <td>
                                                {{ $institution->institution_town ?? "" }}
                                            </td>
                                        </tr>

                                        <tr>
                                            <th>N° de Contact</th>
                                            <td>
                                                {{ $institution->institution_phones ?? "" }}
                                            </td>
                                        </tr>

                                        <tr>
                                            <th>Address</th>
                                            <td>
                                                {{ $institution->institution_address ?? "" }}
                                            </td>
                                        </tr>

                                        <tr>
                                            <th>Site web</th>
                                            <td>
                                                <a href="{{ $institution->institution_website ?? "" }}" target="__black">
                                                    {{ $institution->institution_website ?? "" }}
                                                </a>
                                            </td>
                                        </tr>

                                        <tr>
                                            <th>Liste des campus</th>
                                            <td>
                                                @if($institution->campuses)
                                                    @foreach($institution->campuses as $campus)
                                                        <a href="{{ route('admins.academic.campus.show', $campus->id) }}">
                                                            {{ ucfirst($campus->name) ?? "" }}
                                                        </a>
                                                    @endforeach
                                                @endif
                                            </td>
                                        </tr>

                                        <tr class="text-justify">
                                            <th>Description</th>
                                            <td>{{ $institution->institution_description ?? "" }}</td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
