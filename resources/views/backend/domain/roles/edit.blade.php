@extends('backend.layout.base')

@section('title', "Edition du role")

@section('content')
    <div class="container-fluid">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="nk-block-head nk-block-head-sm">
                    <div class="nk-block-between">
                        <div class="nk-block-head-content">
                            <h3 class="nk-block-title page-title">Edition du role</h3>
                        </div>
                        <div class="nk-block-head-content">
                            <div class="toggle-wrap nk-block-tools-toggle">
                                <div class="toggle-expand-content" data-content="more-options">
                                    <ul class="nk-block-tools g-3">
                                        <li class="nk-block-tools-opt">
                                            <a class="btn btn-dim btn-primary btn-sm" href="{{ route('admins.roles.index') }}">
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
                        <div class="card-inner">
                            <div class="row justify-content-center mb-4">
                                <div class="col-md-6">
                                    <form action="{{ route('admins.roles.update', $role->id) }}" method="post" class="form-validate" novalidate="novalidate">
                                        @csrf
                                        @method('PUT')
                                        <div class="row g-gs">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="form-label" for="role">Role</label>
                                                    <div class="form-control-wrap">
                                                        <input
                                                            type="text"
                                                            class="form-control @error('role') error @enderror"
                                                            id="role"
                                                            name="role"
                                                            value="{{ old('role') ?? $role->title }}"
                                                            placeholder="Definir le role"
                                                            required>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                @foreach($permissions as $permission)
                                                    <tr>
                                                        <td>
                                                            <input
                                                                type="checkbox"
                                                                name="permission[{{ $permission->name }}]"
                                                                value="{{ $permission->name }}"
                                                                class='permission'
                                                                {{
                                                                    in_array($permission->name, $rolePermissions)
                                                                    ? 'checked'
                                                                    : ''
                                                                }}>
                                                        </td>
                                                        <td>{{ $permission->name }}</td>
                                                        <td>{{ $permission->guard_name }}</td>
                                                    </tr>
                                                @endforeach
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <button type="submit" class="btn btn-md btn-primary">Save</button>
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
    <script type="text/javascript">
        $(document).ready(function() {
            $('[name="all_permission"]').on('click', function() {
                if($(this).is(':checked')) {
                    $.each($('.permission'), function() {
                        $(this).prop('checked',true);
                    });
                } else {
                    $.each($('.permission'), function() {
                        $(this).prop('checked',false);
                    });
                }
            });
        });
    </script>
@endsection
