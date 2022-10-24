@extends('backend.layout.base')

@section('title')
    Professor Detail
@endsection

@section('content')
    <div class="container-fluid">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="nk-block-head nk-block-head-sm">
                    <div class="nk-block-between">
                        <div class="nk-block-head-content">
                            <h3 class="nk-block-title page-title">
                                Show Professor
                            </h3>
                        </div>
                        <div class="nk-block-head-content">
                            <div class="toggle-wrap nk-block-tools-toggle">
                                <div class="toggle-expand-content" data-content="more-options">
                                    <ul class="nk-block-tools g-3">
                                        <li class="preview-item">
                                            <div class="custom-control custom-control-md custom-switch">
                                                <input
                                                    type="checkbox"
                                                    class="custom-control-input"
                                                    name="activated"
                                                    data-id="{{ $viewModel->professor()->user_id }}"
                                                    {{ $viewModel->user()->status ? "checked" : "" }}
                                                    onclick="changeProfessorStatus(event.target, {{ $viewModel->professor()->user_id }});"
                                                    id="activated">
                                                <label class="custom-control-label" for="activated"></label>
                                            </div>
                                        </li>
                                        <li class="preview-item">
                                            <a class="btn btn-outline-primary btn-sm" href="{{ $viewModel->indexUrl }}">
                                                <em class="icon ni ni-arrow-long-left"></em>
                                                <span>Touts les professeurs</span>
                                            </a>
                                        </li>
                                        @can('admin-update')
                                            <li class="preview-item">
                                                <a
                                                    href="{{ $viewModel->editUrl }}"
                                                    class="btn btn-outline-primary btn-sm">
                                                    <em class="icon ni ni-edit mr-1"></em>
                                                    Editer
                                                </a>
                                            </li>
                                        @endcan
                                        @can('admin-delete')
                                            <li class="preview-item">
                                                <form
                                                    action="{{ $viewModel->deleteUrl }}"
                                                    method="POST"
                                                    class="d-inline-block"
                                                    onsubmit="return confirm('Are you sure you want to delete this item?');"
                                                >
                                                    @method('DELETE')
                                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                    <button type="submit" class="btn btn-outline-danger btn-sm">
                                                        <em class="icon ni ni-trash-empty-fill"></em>
                                                        Delete le professeur
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
                                        @if($viewModel->professor()->images)
                                            src="{{ asset('storage/'.$viewModel->professor()->images) }}"
                                        @else
                                            src="{{ asset('assets/admins/images/man.webp') }}"
                                        @endif
                                        title="{{ $viewModel->professor()->username }}"
                                        style="object-fit: contain"
                                        class="img-fluid user-avatar-xl mb-3 text-center rounded-circle border-danger"
                                    >
                                </div>
                            </div>
                            <div class="card-inner">
                                <div class="nk-block">
                                    <div class="nk-block-head">
                                        <span class="title">Information du professeur</span>
                                    </div>
                                    <div class="profile-ud-list">
                                        <div class="profile-ud-item">
                                            <div class="profile-ud wider">
                                                <span class="profile-ud-label">Nom</span>
                                                <span class="profile-ud-value">
                                                    {{ ucfirst($viewModel->professor()->username)  ?? "" }}
                                                </span>
                                            </div>
                                        </div>
                                        <div class="profile-ud-item">
                                            <div class="profile-ud wider">
                                                <span class="profile-ud-label">Post-nom</span>
                                                <span class="profile-ud-value">
                                                    {{ ucfirst($viewModel->professor()->firstname)  ?? "" }}
                                                </span>
                                            </div>
                                        </div>
                                        <div class="profile-ud-item">
                                            <div class="profile-ud wider">
                                                <span class="profile-ud-label">Prenom</span>
                                                <span class="profile-ud-value">
                                                    {{ ucfirst($viewModel->professor()->lastname)  ?? "" }}
                                                </span>
                                            </div>
                                        </div>
                                        <div class="profile-ud-item">
                                            <div class="profile-ud wider">
                                                <span class="profile-ud-label">Matricule</span>
                                                <span class="profile-ud-value">
                                                    {{ $viewModel->professor()->matriculate  ?? "" }}
                                                </span>
                                            </div>
                                        </div>
                                        <div class="profile-ud-item">
                                            <div class="profile-ud wider">
                                                <span class="profile-ud-label">Email</span>
                                                <span class="profile-ud-value">
                                                    {{ $viewModel->professor()->email  ?? "" }}
                                                </span>
                                            </div>
                                        </div>

                                        <div class="profile-ud-item">
                                            <div class="profile-ud wider">
                                                <span class="profile-ud-label">N° Telephone</span>
                                                <span class="profile-ud-value">
                                                    {{ $viewModel->professor()->phones  ?? "" }}
                                                </span>
                                            </div>
                                        </div>
                                        <div class="profile-ud-item">
                                            <div class="profile-ud wider">
                                                <span class="profile-ud-label">Pays d'origine</span>
                                                <span class="profile-ud-value">
                                                    {{ $viewModel->professor()->nationality  ?? "" }}
                                                </span>
                                            </div>
                                        </div>

                                        <div class="profile-ud-item">
                                            <div class="profile-ud wider">
                                                <span class="profile-ud-label">Ville</span>
                                                <span class="profile-ud-value">
                                                    {{ $viewModel->professor()->location  ?? "" }}
                                                </span>
                                            </div>
                                        </div>

                                        <div class="profile-ud-item">
                                            <div class="profile-ud wider">
                                                <span class="profile-ud-label">Date Naissance</span>
                                                <span class="profile-ud-value">
                                                    {{ $viewModel->professor()->birthdays  ?? "" }}
                                                </span>
                                            </div>
                                        </div>

                                        <div class="profile-ud-item">
                                            <div class="profile-ud wider">
                                                <span class="profile-ud-label">Genre</span>
                                                <span class="profile-ud-value">
                                                    @if($viewModel->professor()->gender == 'male')
                                                        MASCULIN
                                                    @else
                                                        FEMININ
                                                    @endif
                                                </span>
                                            </div>
                                        </div>

                                        <div class="profile-ud-item">
                                            <div class="profile-ud wider">
                                                <span class="profile-ud-label">Annee academique</span>
                                                <span class="profile-ud-value"></span>
                                            </div>
                                        </div>

                                        <div class="profile-ud-item">
                                            <div class="profile-ud wider">
                                                <span class="profile-ud-label">Role</span>
                                                <span class="profile-ud-value">
                                                    {{ $viewModel->user()->getRoleNames() ?? "" }}
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
                                                    {{ $viewModel->professor()->created_at->format('Y-m-d')  ?? "" }}
                                                </span>
                                            </div>
                                        </div>
                                        <div class="profile-ud-item">
                                            <div class="profile-ud wider">
                                                <span class="profile-ud-label">Dernière mise à jour</span>
                                                <span class="profile-ud-value">
                                                    {{ $viewModel->professor()->updated_at->format('Y-m-d')  ?? "" }}
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

        let changeProfessorStatus = async (_this, id) => {
            const status = $(_this).prop('checked') === true ? 1 : 0;
            let _token = $('meta[name="csrf-token"]').attr('content');
            let data = {
                status: status,
                professor: id
            }
            let headers = {
                'Content-type': 'application/json; charset=UTF-8',
                'x-csrf-token': _token,
            }

            await fetch('/admins/professor-status', {
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
