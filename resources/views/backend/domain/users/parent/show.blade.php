@extends('backend.layout.base')

@section('title', "Detail sur le parent")

@section('content')
    <div class="container-fluid">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="nk-block-head nk-block-head-sm">
                    <div class="nk-block-between">
                        <div class="nk-block-head-content">
                            <h3 class="nk-block-title page-title">
                                Parent Detail
                            </h3>
                        </div>
                        <div class="nk-block-head-content">
                            <div class="toggle-wrap nk-block-tools-toggle">
                                <div class="toggle-expand-content" data-content="more-options">
                                    <ul class="nk-block-tools g-3">
                                        <li class="nk-block-tools-opt">
                                            <a class="btn btn-dim btn-primary btn-sm" href="{{ route('admins.users.guardian.index') }}">
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
                    <div class="card">
                        <div class="card-aside-wrap">
                            <div class="card-inner card-inner-lg">
                                <div class="tab-content">
                                    <div class="tab-pan active" >
                                        <div class="nk-block-head">
                                            <div class="nk-block-between d-flex justify-content-between">
                                                <div class="nk-block-head-content">
                                                    <h4 class="nk-block-title">Personnel Information</h4>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="nk-block">
                                            <div class="nk-data data-list">
                                                <div class="data-head">
                                                    <div class="tb-lead d-flex flex-wrap">
                                                        @foreach($parent->user->roles as $role)
                                                            <span class="badge bg-primary mx-1 mb-1">{{$role->name ?? "" }}</span>
                                                        @endforeach
                                                    </div>
                                                </div>
                                                <div class="data-item">
                                                    <div class="data-col">
                                                        <span class="data-label">Nom</span>
                                                        <span class="data-value">{{ $parent->name_guardian ?? "" }}</span>
                                                    </div>
                                                </div>
                                                <div class="data-item">
                                                    <div class="data-col">
                                                        <span class="data-label">Post nom</span>
                                                        <span class="data-value">{{ $parent->firstName_guardian ?? "" }}</span>
                                                    </div>
                                                </div>
                                                <div class="data-item">
                                                    <div class="data-col">
                                                        <span class="data-label">Post nom</span>
                                                        <span class="data-value">{{ $parent->email_guardian ?? "" }}</span>
                                                    </div>
                                                </div>
                                                <div class="data-item">
                                                    <div class="data-col">
                                                        <span class="data-label">Gender</span>
                                                        <span class="data-value">{{ ucfirst($parent->gender) ?? "" }}</span>
                                                    </div>
                                                </div>
                                                <div class="data-item">
                                                    <div class="data-col">
                                                        <span class="data-label">Phones</span>
                                                        <span class="data-value">{{ $parent->phones ?? "" }}</span>
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
        </div>
    </div>
@endsection
