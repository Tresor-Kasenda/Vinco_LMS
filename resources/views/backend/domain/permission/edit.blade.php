@extends('backend.layout.base')

@section('title')
    Edition de permission
@endsection

@section('content')
    <div class="container-fluid">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="nk-block-head nk-block-head-sm">
                    <div class="nk-block-between">
                        <div class="nk-block-head-content">
                            <h3 class="nk-block-title page-title">Edition du permission</h3>
                        </div>
                        <div class="nk-block-head-content">
                            <div class="toggle-wrap nk-block-tools-toggle">
                                <div class="toggle-expand-content" data-content="more-options">
                                    <ul class="nk-block-tools g-3">
                                        <li class="nk-block-tools-opt">
                                            <a class="btn btn-outline-primary" href="{{ $viewModel->indexUrl }}">
                                                <em class="icon ni ni-arrow-long-left"></em>
                                                <span>Voir les permissions</span>
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
                        <div class="card-inner">
                            <div class="row justify-content-center mb-4">
                                <div class="col-md-12">
                                    <form action="{{ route('admins.permissions.update', $viewModel->permission->id) }}" method="post" class="form-validate" novalidate="novalidate">
                                        @csrf
                                        @method('PUT')
                                        <div class="row g-gs justify-content-center">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="form-label" for="name">Role</label>
                                                    <div class="form-control-wrap">
                                                        <input
                                                            type="text"
                                                            class="form-control @error('name') error @enderror"
                                                            id="name"
                                                            name="name"
                                                            value="{{ old('name') ?? $viewModel->permission->name }}"
                                                            placeholder="Definir la permission"
                                                            required>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-12 text-center">
                                                <div class="form-group">
                                                    <button type="submit" class="btn btn-outline-primary">
                                                        <em class="icon ni ni-save mr-2"></em>
                                                        Mettre a jours
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
