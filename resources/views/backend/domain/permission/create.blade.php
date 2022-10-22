@extends('backend.layout.base')

@section('title')
    Create la permission
@endsection

@section('content')
    <div class="container-fluid">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="nk-block-head nk-block-head-sm">
                    <div class="nk-block-between">
                        <div class="nk-block-head-content">
                            <h3 class="nk-block-title page-title">Ajouter une permission</h3>
                        </div>
                        <div class="nk-block-head-content">
                            <div class="toggle-wrap nk-block-tools-toggle">
                                <div class="toggle-expand-content" data-content="more-options">
                                    <ul class="nk-block-tools g-3">
                                        <li class="nk-block-tools-opt">
                                            <a class="btn btn-outline-primary" href="{{ route('admins.roles.index') }}">
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
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            <div class="row justify-content-center mb-4">
                                <div class="col-md-12">
                                    <form action="{{ route('admins.permissions.store') }}" method="post" class="form-validate" novalidate="novalidate">
                                        @csrf
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
                                                            value="{{ old('name') }}"
                                                            placeholder="Definir la permission"
                                                            required>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-12 text-center">
                                                <div class="form-group">
                                                    <button type="submit" class="btn btn-outline-primary">
                                                        <em class="icon ni ni-save mr-2"></em>
                                                        Enregister la permission
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


@section('scripts')
    <script>
        $(document).ready(function() {
            $("#all_permission").click(function () {
                $('input:checkbox').not(this).prop('checked', this.checked);
            });
        });
    </script>
@endsection
