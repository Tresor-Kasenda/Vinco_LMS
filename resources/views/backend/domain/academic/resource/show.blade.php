@extends('backend.layout.base')

@section('title', "Detail sur la lecon")

@section('content')
    <div class="container-fluid">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="nk-block-head nk-block-head-sm">
                    <div class="nk-block-between">
                        <div class="nk-block-head-content">
                            <h6 class="nk-block-title page-title">
                                Resource Details
                            </h6>
                        </div>
                        <div class="nk-block-head-content">
                            <div class="toggle-wrap nk-block-tools-toggle">
                                <div class="toggle-expand-content" data-content="more-options">
                                    <ul class="nk-block-tools g-3">
                                        <li class="nk-block-tools-opt">
                                            <a class="btn btn-dim btn-primary btn-sm" href="{{ route('admins.academic.resource.index') }}">
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
                                            @if($resource->lesson->chapter->course->images)
                                                src="{{ asset('storage/'.$resource->lesson->chapter->course->images) }}"
                                            @else
                                                src="{{ asset('assets/admins/images/default.png') }}"
                                            @endif
                                            title="{{ $resource->name }}"
                                            class="img-fluid user-avatar-xl mb-3 rounded-circle border-danger"
                                        >
                                    </div>
                                    <table class="table">
                                        <tbody>
                                        <tr></tr>
                                        <tr>
                                            <th>Cours</th>
                                            <td>{{ ucwords($resource->lesson->chapter->course->name) ?? "" }}</td>
                                        </tr>
                                        <tr>
                                            <th>Chapitre</th>
                                            <td>{{ ucwords($resource->lesson->chapter->name) ?? "" }}</td>
                                        </tr>
                                        <tr>
                                            <th>Professeur</th>
                                            <td>{{ ucwords($resource->lesson->chapter->course->user->name) ?? "" }}</td>
                                        </tr>
                                        <tr>
                                            <th>Title du lecon</th>
                                            <td>{{ ucfirst($resource->name) ?? "" }}</td>
                                        </tr>
                                        <tr class="text-center">
                                            <th>Resource</th>
                                            <td>
                                                <a class="btn btn-sm btn-secondary btn-dim text-center" href="{{ asset('storage/'. $resource->path) }}" download>
                                                    Telecharger <em class="icon ni ni-download"></em>
                                                </a>
                                            </td>
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
