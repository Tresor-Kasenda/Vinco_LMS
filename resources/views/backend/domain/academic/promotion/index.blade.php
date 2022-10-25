@extends('backend.layout.base')

@section('title', "Gestion des promotions")

@section('content')
    <div class="container-fluid">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="nk-block-head nk-block-head-sm">
                    <div class="nk-block-between">
                        <div class="nk-block-head-content">
                            <h3 class="nk-block-title page-title">Gestion des promotions</h3>
                        </div>
                        <div class="nk-block-head-content">
                            <div class="toggle-wrap nk-block-tools-toggle">
                                <div class="toggle-expand-content" data-content="more-options">
                                    <ul class="nk-block-tools g-3">
                                        @can('promotion-create')
                                            <li class="nk-block-tools-opt">
                                                <a class="btn btn-outline-primary btn-sm" href="{{ route('admins.academic.promotion.create') }}">
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
                            <tr class="nk-tb-item nk-tb-head  text-center">
                                <th class="nk-tb-col">
                                    <span>PROMOTION</span>
                                </th>
                                <th class="nk-tb-col">
                                    <span>FILIAIRE</span>
                                </th>
                                @if(auth()->user()->hasRole('Super Admin'))
                                    <th class="nk-tb-col">
                                        <span>INSTITUTION</span>
                                    </th>
                                @endif
                                <th class="nk-tb-col">
                                    <span>ANNEE ACADEMIC</span>
                                </th>
                                <th class="nk-tb-col nk-tb-col-tools">
                                    <span>ACTION</span>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($promotions as $promotion)
                                <tr class="nk-tb-item text-center">
                                    <td class="nk-tb-col">
                                        <span class="tb-lead">{{ ucfirst($promotion->name) ?? ""}}</span>
                                    </td>
                                    <td class="nk-tb-col">
                                        <span class="tb-lead">{{ ucfirst($promotion->subsidiary->name) ?? "" }}</span>
                                    </td>
                                    @if(auth()->user()->hasRole('Super Admin'))
                                        <td class="nk-tb-col">
                                            <span class="tb-lead">{{ ucfirst($promotion->subsidiary->department->campus->institution->institution_name) ?? "" }}</span>
                                        </td>
                                    @endif
                                    <td class="nk-tb-col">
                                        <span class="tb-lead">
                                            {{ $promotion->academic->start_date ?? ""}}
                                            -
                                            {{ $promotion->academic->end_date ?? ""}}
                                        </span>
                                    </td>
                                    <td class="nk-tb-col">
                                        @can('promotion-view')
                                            <div class="tb-lead justify-content-center">
                                                <a href="{{ route('admins.academic.promotion.show', $promotion->id) }}"
                                                   class="btn btn-outline-primary btn-sm" title="">
                                                    <em class="icon ni ni-eye-alt-fill"></em>
                                                    <span>Detail Professeur</span>
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
