@extends('backend.layout.base')

@section('title')
    Admins Details
@endsection

@section('content')
    <div class="container-fluid">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="nk-block-head nk-block-head-sm">
                    <div class="nk-block-between">
                        <div class="nk-block-head-content">
                            <h3 class="nk-block-title page-title">
                                Show Admin
                            </h3>
                        </div>
                        <div class="nk-block-head-content">
                            <div class="toggle-wrap nk-block-tools-toggle">
                                <div class="toggle-expand-content" data-content="more-options">
                                    <ul class="nk-block-tools g-3">
                                        @can('user-status')
                                            <li class="preview-item">
                                                <div class="custom-control custom-control-md custom-switch">
                                                    <input
                                                        type="checkbox"
                                                        class="custom-control-input"
                                                        name="activated"
                                                        data-id="{{ $admin->id }}"
                                                        {{ $admin->status ? "checked" : "" }}
                                                        onclick="changeAdminStatus(event.target, {{ $admin->id }});"
                                                        id="activated">
                                                    <label class="custom-control-label" for="activated"></label>
                                                </div>
                                            </li>
                                        @endcan
                                        <li class="preview-item">
                                            <a class="btn btn-outline-primary btn-sm" href="{{ route('admins.users.admin.index') }}">
                                                <em class="icon ni ni-arrow-long-left"></em>
                                                <span>Touts les admins</span>
                                            </a>
                                        </li>
                                        @can('user-update')
                                            <li class="preview-item">
                                                <a
                                                    href="{{ route('admins.users.admin.edit', $admin->id) }}"
                                                    class="btn btn-outline-primary btn-sm">
                                                    <em class="icon ni ni-edit mr-1"></em>
                                                    Editer
                                                </a>
                                            </li>
                                        @endcan
                                        @can('user-delete')
                                            <li class="preview-item">
                                                <form
                                                    action="{{ route('admins.users.admin.destroy', $admin->id) }}"
                                                    method="POST"
                                                    class="d-inline-block"
                                                    onsubmit="return confirm('Are you sure you want to delete this item?');"
                                                >
                                                    @method('DELETE')
                                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                    <button type="submit" class="btn btn-outline-danger btn-sm">
                                                        <em class="icon ni ni-trash-empty-fill"></em>
                                                        Delete Institution
                                                    </button>
                                                </form>
                                            </li>
                                        @endcan
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="nk-block">
                    <div class="nk-block nk-block-lg">
                        <div class="card card-preview">
                            <div class="card-body border-bottom">
                                <div class="text-center">
                                    <img
                                        src="{{ asset('assets/admins/images/man.webp') }}"
                                        title="{{ $admin->name }}"
                                        class="img-fluid user-avatar-xl mb-3 text-center rounded-circle border-danger"
                                    >
                                </div>
                            </div>
                            <div class="card-inner">
                                <div class="nk-block">
                                    <div class="nk-block-head">
                                        <span class="title">Information de l'adminstrateur</span>
                                    </div>
                                    <div class="profile-ud-list">
                                        <div class="profile-ud-item">
                                            <div class="profile-ud wider">
                                                <span class="profile-ud-label">Nom Admin</span>
                                                <span class="profile-ud-value">
                                                    {{ ucfirst($admin->name)  ?? "" }}
                                                </span>
                                            </div>
                                        </div>
                                        <div class="profile-ud-item">
                                            <div class="profile-ud wider">
                                                <span class="profile-ud-label">Email</span>
                                                <span class="profile-ud-value">
                                                    {{ $admin->email ?? "" }}
                                                </span>
                                            </div>
                                        </div>
                                        <div class="profile-ud-item">
                                            <div class="profile-ud wider">
                                                <span class="profile-ud-label">Institution</span>
                                                <span class="profile-ud-value">
                                                    {{ ucfirst($admin->institution->institution_name ) ?? "" }}
                                                </span>
                                            </div>
                                        </div>
                                        <div class="profile-ud-item">
                                            <div class="profile-ud wider">
                                                <span class="profile-ud-label">Status</span>
                                                <span class="profile-ud-value">
                                                    @if($admin->status)
                                                        <span class="badge badge-success ms-0">Activée</span>
                                                    @else
                                                        <span class="badge badge-danger ms-0">Désactivée</span>
                                                    @endif
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="nk-divider divider md"></div>
                                <div class="nk-block">
                                    <div class="nk-block-head">
                                        <span class="title">Informations supplémentaires</span>
                                    </div>
                                    <div class="profile-ud-list">
                                        <div class="profile-ud-item">
                                            <div class="profile-ud wider">
                                                <span class="profile-ud-label">Date de creation</span>
                                                <span class="profile-ud-value">
                                                    {{ $admin->created_at->format('Y-m-d')  ?? "" }}
                                                </span>
                                            </div>
                                        </div>
                                        <div class="profile-ud-item">
                                            <div class="profile-ud wider">
                                                <span class="profile-ud-label">Dernière mise à jour</span>
                                                <span class="profile-ud-value">
                                                    {{ $admin->updated_at->format('Y-m-d')  ?? "" }}
                                                </span>
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

@section('scripts')
    <script>

        let changeAdminStatus = async (_this, id) => {
            const status = $(_this).prop('checked') === true ? 1 : 0;
            let _token = $('meta[name="csrf-token"]').attr('content');
            let data = {
                status: status,
                admin: id
            }
            let headers = {
                'Content-type': 'application/json; charset=UTF-8',
                'x-csrf-token': _token,
            }

            await fetch('/admins/admin-status', {
                method: "POST",
                body: JSON.stringify(data),
                headers: headers
            })
                .then(response => response.json())
                .then((data) => {
                    var result = Object.values(data)
                    Swal.fire(`Status ${result[1].name}`, `${result[0]}`, 'success')
                })
                .catch((error) => {
                    Swal.fire("Bonne nouvelle", "Operation executez avec success","success")
                })
        }
    </script>
@endsection
