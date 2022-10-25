@extends('backend.layout.base')

@section('title')
    Show Promotion
@endsection

@section('content')
    <div class="container-fluid">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="nk-block-head nk-block-head-sm">
                    <div class="nk-block-between">
                        <div class="nk-block-head-content">
                            <h3 class="nk-block-title page-title">
                                Show Promotion
                            </h3>
                        </div>

                        <div class="nk-block-head-content">
                            <div class="toggle-wrap nk-block-tools-toggle">
                                <div class="toggle-expand-content" data-content="more-options">
                                    <ul class="nk-block-tools g-3">
                                        <li class="preview-item">
                                            <a class="btn btn-outline-primary btn-sm" href="{{ route('admins.academic.promotion.index') }}">
                                                <em class="icon ni ni-arrow-long-left"></em>
                                                <span>Toutes les promotions</span>
                                            </a>
                                        </li>
                                        @can('campus-update')
                                            <li class="preview-item">
                                                <a
                                                    href="{{ route('admins.academic.promotion.edit', $promotion->id) }}"
                                                    class="btn btn-outline-primary btn-sm">
                                                    <em class="icon ni ni-edit mr-1"></em>
                                                    Editer
                                                </a>
                                            </li>
                                        @endcan
                                        @can('campus-delete')
                                            <li class="preview-item">
                                                <form
                                                    action="{{ route('admins.academic.promotion.destroy', $promotion->id) }}"
                                                    method="POST"
                                                    class="d-inline-block"
                                                    onsubmit="return confirm('Are you sure you want to delete this item?');"
                                                >
                                                    @method('DELETE')
                                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                    <button type="submit" class="btn btn-outline-danger btn-sm">
                                                        <em class="icon ni ni-trash-empty-fill"></em>
                                                        Supprimer la promotion
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
                            <div class="card-inner">
                                <div class="nk-block">
                                    <div class="nk-block-head">
                                        <span class="title">Information du promotion</span>
                                    </div>
                                    <div class="profile-ud-list">
                                        <div class="profile-ud-item">
                                            <div class="profile-ud wider">
                                                <span class="profile-ud-label">Nom</span>
                                                <span class="profile-ud-value">
                                                    {{ ucfirst($promotion->name)  ?? "" }}
                                                </span>
                                            </div>
                                        </div>
                                        <div class="profile-ud-item">
                                            <div class="profile-ud wider">
                                                <span class="profile-ud-label">Filiaire</span>
                                                <span class="profile-ud-value">
                                                    {{ ucfirst($promotion->subsidiary->name)  ?? "" }}
                                                </span>
                                            </div>
                                        </div>
                                        <div class="profile-ud-item">
                                            <div class="profile-ud wider">
                                                <span class="profile-ud-label">Departement</span>
                                                <span class="profile-ud-value">
                                                    {{ ucfirst($promotion->subsidiary->department->name)  ?? "" }}
                                                </span>
                                            </div>
                                        </div>
                                        <div class="profile-ud-item">
                                            <div class="profile-ud wider">
                                                <span class="profile-ud-label">Annee academique</span>
                                                <span class="profile-ud-value">
                                                    {{
                                                    \Carbon\Carbon::createFromFormat('Y-m-d', $promotion->academic->start_date)->format('M, Y')
                                                    ?? ""
                                                }}-
                                                {{
                                                    \Carbon\Carbon::createFromFormat('Y-m-d', $promotion->academic->end_date)->format('M,Y')
                                                    ?? ""
                                                }}
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
                                                    {{ $promotion->created_at->format('Y-m-d')  ?? "" }}
                                                </span>
                                            </div>
                                        </div>
                                        <div class="profile-ud-item">
                                            <div class="profile-ud wider">
                                                <span class="profile-ud-label">Dernière mise à jour</span>
                                                <span class="profile-ud-value">
                                                    {{ $promotion->updated_at->format('Y-m-d')  ?? "" }}
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
