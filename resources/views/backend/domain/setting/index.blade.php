@extends('backend.layout.base')

@section('title', "Tableau de bord")

@section('content')
    <div class="container-fluid">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="nk-block-head">
                    <div class="nk-block-head-content">
                        <h4 class="nk-block-title page-title h5">Admin Setting</h4>
                    </div>
                </div>
                <div class="nk-block nk-block-lg">
                    <div class="card card-stretch">
                        <ul class="nav nav-tabs nav-tabs-mb-icon nav-tabs-card">
                            <li class="nav-item">
                                <a class="nav-link active" data-bs-toggle="tab" href="#basic">
                                    <span>Basic</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-bs-toggle="tab" href="#system">
                                    <span>System</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-bs-toggle="tab" href="#language">
                                    <span>Language</span>
                                </a>
                            </li>
                        </ul>
                        <div class="card-inner">
                            <div class="tab-content">
                                <div class="tab-pane active" id="basic">
                                    <div class="nk-block">
                                        <div class="row g-gs">
                                            <div class="col-xxl-8 col-lg-12">
                                                @include('backend.components._basics')
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane" id="system">
                                    <div class="nk-block">
                                        <div class="row g-gs">
                                            <div class="col-xxl-8 col-lg-12">
                                                @include('backend.components._system')
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane" id="language">
                                    <div class="nk-block">
                                        <div class="row g-gs">
                                            <div class="col-xxl-8 col-lg-12">
                                                @include('backend.components._language')
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
