@extends('backend.layout.base')

@section('title')
    Show Promotion
@endsection

@section('content')
    <div class="container-fluid">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="nk-block-head nk-block-head-sm">
                    <div class="nk-block-between">
                        <div class="nk-block-head-content">
                            <h3 class="nk-block-title page-title">
                                Show Promotion
                            </h3>
                        </div>

                        <div class="nk-block-head-content">
                            <div class="toggle-wrap nk-block-tools-toggle">
                                <div class="toggle-expand-content" data-content="more-options">
                                    <ul class="nk-block-tools g-3">
                                        <li class="nk-block-tools-opt">
                                            <a class="btn btn-outline-light d-none d-md-inline-flex"
                                               href="{{ route('admins.academic.promotion.index') }}">
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
                                            @if($promotion->images)
                                                src="{{ asset('storage/'.$promotion->images) }}"
                                            @else
                                                src="{{ asset('assets/admins/images/man.webp') }}"
                                            @endif
                                            title="{{ $promotion->name }}"
                                            class="img-fluid user-avatar-xl mb-3 text-center rounded-circle border-danger"
                                        >
                                    </div>
                                    <table class="table">
                                        <tbody>
                                        <tr>
                                            <th>Nom du Filiaire</th>
                                            <td>{{ ucfirst($promotion->name) ?? "" }}</td>
                                        </tr>
                                        <tr>
                                            <th>Filiaire</th>
                                            <td>{{ ucfirst($promotion->subsidiary->name) ?? "" }}</td>
                                        </tr>
                                        <tr>
                                            <th>Departement</th>
                                            <td>{{ ucfirst($promotion->subsidiary->department->name) ?? "" }}</td>
                                        </tr>
                                        <tr>
                                            <th>Annee academique</th>
                                            <td>
                                                {{
                                                    \Carbon\Carbon::createFromFormat('Y-m-d', $promotion->academic->start_date)->format('M, Y')
                                                    ?? ""
                                                }}-
                                                {{
                                                    \Carbon\Carbon::createFromFormat('Y-m-d', $promotion->academic->end_date)->format('M,Y')
                                                    ?? ""
                                                }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Description</th>
                                            <td>{{ $promotion->description ?? "-" }}</td>
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
