@extends('backend.layout.base')

@section('title')
    Create Role
@endsection

@section('content')
    <div class="container-fluid">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="nk-block-head nk-block-head-sm">
                    <div class="nk-block-between">
                        <div class="nk-block-head-content">
                            <h3 class="nk-block-title page-title">Ajouter un role</h3>
                        </div>
                        <div class="nk-block-head-content">
                            <div class="toggle-wrap nk-block-tools-toggle">
                                <div class="toggle-expand-content" data-content="more-options">
                                    <ul class="nk-block-tools g-3">
                                        <li class="nk-block-tools-opt">
                                            <a class="btn btn-outline-primary btn-sm" href="{{ route('admins.roles.index') }}">
                                                <em class="icon ni ni-arrow-long-left"></em>
                                                <span>Voir les roles</span>
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
                                    <form action="{{ route('admins.roles.store') }}" method="post" class="form-validate" novalidate="novalidate">
                                        @csrf
                                        <div class="row g-gs">
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
                                                            placeholder="Definir le role"
                                                            required>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-8">
                                                <div class="form-group">
                                                    <label class="form-label" for="permission">Permissions</label>
                                                    <br>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="d-inline-block">
                                                                <div>
                                                                    <label class="form-check">
                                                                        <input
                                                                            type="checkbox"
                                                                            id="all_permission"
                                                                            name="all_permission"
                                                                            class="form-check-input">
                                                                        <span class="form-check-label">All Permission</span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <br>
                                                    <div class="row">
                                                        @foreach($permissions as $permission)
                                                            <div class="col-md-4">
                                                                <div class="d-inline-block mt-1 m-3">
                                                                    <div>
                                                                        <label class="form-check">
                                                                            <input
                                                                                type="checkbox"
                                                                                name="permission[]"
                                                                                id="permission[]"
                                                                                value="{{ $permission->id }}"
                                                                                class="form-check-input">
                                                                            <span class="form-check-label">
                                                                                {{ $permission->name  ?? "" }}
                                                                            </span>
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12 text-center">
                                                <div class="form-group">
                                                    <button type="submit" class="btn btn-outline-primary">
                                                        <em class="icon ni ni-save mr-2"></em>
                                                        Enregister le role
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
