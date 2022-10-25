@extends('backend.layout.base')

@section('title')
    Detail Filiaire
@endsection

@section('content')
    <div class="container-fluid">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="nk-block-head nk-block-head-sm">
                    <div class="nk-block-between">
                        <div class="nk-block-head-content">
                            <h3 class="nk-block-title page-title">
                                Show Department
                            </h3>
                        </div>

                        <div class="nk-block-head-content">
                            <div class="toggle-wrap nk-block-tools-toggle">
                                <div class="toggle-expand-content" data-content="more-options">
                                    <ul class="nk-block-tools g-3">
                                        <li class="preview-item">
                                            <a class="btn btn-outline-primary btn-sm" href="{{ $viewModel->indexUrl }}">
                                                <em class="icon ni ni-arrow-long-left"></em>
                                                <span>Touts les campus</span>
                                            </a>
                                        </li>
                                        @can('filiaire-update')
                                            <li class="preview-item">
                                                <a
                                                    href="{{ $viewModel->editUrl }}"
                                                    class="btn btn-outline-primary btn-sm">
                                                    <em class="icon ni ni-edit mr-1"></em>
                                                    Editer
                                                </a>
                                            </li>
                                        @endcan
                                        @can('filiaire-delete')
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
                                                        Delete le campus
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
                                        @if($viewModel->filiaire()->images)
                                            src="{{ asset('storage/'.$viewModel->filiaire()->images) }}"
                                        @else
                                            src="{{ asset('assets/admins/images/man.webp') }}"
                                        @endif
                                        title="{{ $viewModel->filiaire()->name }}"
                                        style="object-fit: contain"
                                        class="img-fluid user-avatar-xl mb-3 text-center rounded-circle border-danger"
                                    >
                                </div>
                            </div>
                            <div class="card-inner">
                                <div class="nk-block">
                                    <div class="nk-block-head">
                                        <span class="title">Information du campus</span>
                                    </div>
                                    <div class="profile-ud-list">
                                        <div class="profile-ud-item">
                                            <div class="profile-ud wider">
                                                <span class="profile-ud-label">Nom</span>
                                                <span class="profile-ud-value">
                                                    {{ ucfirst($viewModel->filiaire()->name)  ?? "" }}
                                                </span>
                                            </div>
                                        </div>
                                        <div class="profile-ud-item">
                                            <div class="profile-ud wider">
                                                <span class="profile-ud-label">Institution</span>
                                                <span class="profile-ud-value">
                                                    {{ ucfirst($viewModel->filiaire()->department->name)  ?? "" }}
                                                </span>
                                            </div>
                                        </div>
                                        <div class="profile-ud-item">
                                            <div class="profile-ud wider">
                                                <span class="profile-ud-label">Gestionnaire</span>
                                                <span class="profile-ud-value">
                                                    {{ ucfirst($viewModel->filiaire()->user->name)  ?? "" }}
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
                                                    {{ $viewModel->filiaire()->created_at->format('Y-m-d')  ?? "" }}
                                                </span>
                                            </div>
                                        </div>
                                        <div class="profile-ud-item">
                                            <div class="profile-ud wider">
                                                <span class="profile-ud-label">Dernière mise à jour</span>
                                                <span class="profile-ud-value">
                                                    {{ $viewModel->filiaire()->updated_at->format('Y-m-d')  ?? "" }}
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
