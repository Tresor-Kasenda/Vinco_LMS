@extends('backend.layout.base')

@section('title')
    Cours Lists
@endsection

@section('content')
    <div class="container-fluid">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="nk-block-head nk-block-head-sm">
                    <div class="nk-block-between">
                        <div class="nk-block-head-content">
                            <h3 class="nk-block-title page-title">Liste des Cours</h3>
                        </div>
                        <div class="nk-block-head-content">
                            <div class="toggle-wrap nk-block-tools-toggle">
                                <div class="toggle-expand-content" data-content="more-options">
                                    <ul class="nk-block-tools g-3">
                                        @can('cours-create')
                                            <li class="nk-block-tools-opt">
                                                <a class="btn btn-dim btn-primary btn-sm" href="{{ route('admins.academic.course.create') }}">
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
                                    <span>IMAGES</span>
                                </th>
                                <th class="nk-tb-col">
                                    <span>NAME</span>
                                </th>
                                <th class="nk-tb-col">
                                    <span>CATEGORIES</span>
                                </th>
                                <th class="nk-tb-col">
                                    <span>CHAPTERS</span>
                                </th>
                                <th class="nk-tb-col">
                                    <span>PROFESSEURS</span>
                                </th>
                                @if(auth()->user()->hasRole('Super Admin'))
                                    <th class="nk-tb-col">
                                        <span>INSTITUTION</span>
                                    </th>
                                @endif
                                <th class="nk-tb-col nk-tb-col-tools text-center">
                                    <span>ACTION</span>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($courses as $course)
                                <tr class="nk-tb-item text-center">
                                    <td class="nk-tb-col tb-col-sm">
                                        <span class="tb-product justify-content-center">
                                            <img
                                                src="{{ $course->getImages() }}"
                                                alt="{{ ucfirst($course->name) ?? "" }}"
                                                class="thumb">
                                        </span>
                                    </td>
                                    <td class="nk-tb-col">
                                        <span class="tb-lead">
                                            <span class="title">{{ ucfirst($course->name) ?? "" }}</span>
                                        </span>
                                    </td>
                                    <td class="nk-tb-col">
                                        <span class="tb-lead">{{ ucfirst($course->category->name) ?? "" }}</span>
                                    </td>
                                    <td class="nk-tb-col">
                                        <span class="tb-lead">Chapitres : {{ $course->chapters_count ?? "" }} </span>
                                    </td>
                                    <td class="nk-tb-col">
                                        @foreach($course->professors as $professor)
                                            <span class="tb-lead">{{ ucfirst($professor->username) ?? "" }} </span>
                                        @endforeach
                                    </td>
                                    @if(auth()->user()->hasRole('Super Admin'))
                                        <td class="nk-tb-col">
                                            <span class="tb-lead">{{ ucfirst($course->institution->institution_name) ?? "" }} </span>
                                        </td>
                                    @endif
                                    <td class="nk-tb-col">
                                        <span class="tb-lead">
                                            <div class="d-flex">
                                                @can('cours-read')
                                                    <a href="{{ route('admins.academic.course.show', $course->id) }}" class="btn btn-dim btn-primary btn-sm ml-1">
                                                        <em class="icon ni ni-eye"></em>
                                                    </a>
                                                @endcan
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
