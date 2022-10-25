@extends('backend.layout.base')

@section('title')
    Detail frais
@endsection

@section('content')
    <div class="container-fluid">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="nk-block-head nk-block-head-sm">
                    <div class="nk-block-between">
                        <div class="nk-block-head-content">
                            <h6 class="nk-block-title page-title">
                                Detail frais
                            </h6>
                        </div>
                        <div class="nk-block-head-content">
                            <div class="toggle-wrap nk-block-tools-toggle">
                                <div class="toggle-expand-content" data-content="more-options">
                                    <ul class="nk-block-tools g-3">
                                        <li class="nk-block-tools-opt">
                                            <a class="btn btn-dim btn-primary btn-sm" href="{{ route('admins.accounting.fees.index') }}">
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
                                    <table class="table">
                                        <tbody>
                                        <tr>
                                            <th>Type de frais</th>
                                            <td>
                                                {{ $fee->feeType->name ?? "" }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Promotion</th>
                                            <td>
                                                <a href="{{ route('admins.academic.promotion.show', $fee->promotion->id) }}">
                                                    {{ ucwords($fee->promotion->name) ?? "" }}
                                                </a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Montant</th>
                                            <td>
                                                {{ $fee->amount ?? 0 }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Description</th>
                                            <td>{!! $fee->description ?? "" !!}</td>
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
