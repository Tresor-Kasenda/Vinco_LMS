@extends('backend.layout.base')

@section('title')
    Detail Filiaire
@endsection

@section('content')
    <div class="container-fluid">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="nk-block-head nk-block-head-sm">
                    <div class="nk-block-between">
                        <div class="nk-block-head-content">
                            <h3 class="nk-block-title page-title">
                                Show Department
                            </h3>
                        </div>

                        <div class="nk-block-head-content">
                            <div class="toggle-wrap nk-block-tools-toggle">
                                <div class="toggle-expand-content" data-content="more-options">
                                    <ul class="nk-block-tools g-3">
                                        <li class="nk-block-tools-opt">
                                            <a class="btn btn-outline-light d-none d-md-inline-flex"
                                               href="{{ route('admins.academic.filiaire.index') }}">
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
                                            @if($filiaire->images)
                                                src="{{ asset('storage/'.$filiaire->images) }}"
                                            @else
                                                src="{{ asset('assets/admins/images/man.webp') }}"
                                            @endif
                                            title="{{ $filiaire->name }}"
                                            class="img-fluid user-avatar-xl mb-3 text-center rounded-circle border-danger"
                                        >
                                    </div>
                                    <table class="table">
                                        <tbody>
                                        <tr>
                                            <th>Nom du Filiaire</th>
                                            <td>{{ ucfirst($filiaire->name) ?? "" }}</td>
                                        </tr>
                                        <tr>
                                            <th>Nom du Responsable</th>
                                            <td>{{ ucfirst($filiaire->user->name) ?? "" }}</td>
                                        </tr>
                                        <tr>
                                            <th>Department</th>
                                            <td>{{ ucfirst($filiaire->department->name) ?? "" }}</td>
                                        </tr>
                                        <tr>
                                            <th>Faculte</th>
                                            <td>{{ ucfirst($filiaire->department->campus->name) ?? "" }}</td>
                                        </tr>
                                        <tr>
                                            <th>Description</th>
                                            <td>{{ $filiaire->description ?? "-" }}</td>
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
