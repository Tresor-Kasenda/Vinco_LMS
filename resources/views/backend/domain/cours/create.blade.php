@extends('backend.layout.base')

@section('title', "Administration")

@section('content')
    <div class="container-fluid">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="nk-block-head nk-block-head-sm">
                    <div class="nk-block-between">
                        <div class="nk-block-head-content">
                            <h3 class="nk-block-title page-title">Annee academique</h3>
                        </div>
                        <div class="nk-block-head-content">
                            <div class="toggle-wrap nk-block-tools-toggle">
                                <div class="toggle-expand-content" data-content="more-options">
                                    <ul class="nk-block-tools g-3">
                                        <li class="nk-block-tools-opt">
                                            <a class="btn btn-outline-light d-none d-md-inline-flex" href="{{ route('admins.course.index') }}">
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
                            <form action="{{ route('admins.course.store') }}" method="post" class="form-validate" novalidate="novalidate">
                                @csrf
                                <div class="row g-gs">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label" for="category">Categorie</label>
                                            <div class="form-control-wrap">
                                                <select
                                                    class="form-control @error('category') error @enderror"
                                                    data-value="{{ old('category') }}"
                                                    id="category"
                                                    name="category"
                                                    data-placeholder="Select a category"
                                                    required>
                                                    <option label="Choisir une categorie" value=""></option>
                                                    @foreach(\App\Models\Category::all() as $category)
                                                        <option value="{{ $category->id }}">
                                                            {{ $category->name ?? "" }}
                                                        </option>
                                                    @endforeach>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label" for="professor">Professeur</label>
                                            <div class="form-control-wrap">
                                                <select
                                                    class="form-control @error('professor') error @enderror"
                                                    data-value="{{ old('professor') }}"
                                                    id="professor"
                                                    name="professor"
                                                    data-placeholder="Select a professor"
                                                    required>
                                                    <option label="Choisir un professeur" value=""></option>
                                                    @foreach(\App\Models\User::query()->where('role_id', '=', \App\Enums\RoleEnum::PROFESSOR) as $professor)
                                                        <option value="{{ $professor->id }}">
                                                            {{ $professor->name ?? "" }}-{{ $professor->firstName ?? "" }}
                                                        </option>
                                                    @endforeach>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label" for="name">Nom du cours</label>
                                            <div class="form-control-wrap">
                                                <input
                                                    type="text"
                                                    class="form-control @error('name') error @enderror"
                                                    id="name"
                                                    name="name"
                                                    value="{{ old('name') }}"
                                                    placeholder="Saisir le nom du cours"
                                                    required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label" for="images">Image du cours</label>
                                            <div class="form-control-wrap">
                                                <input
                                                    type="file"
                                                    class="form-control @error('images') error @enderror"
                                                    id="images"
                                                    name="images"
                                                    value="{{ old('images') }}"
                                                    placeholder="Selectionner la photo du cours"
                                                    required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="form-label" for="duration">Duree du cours</label>
                                            <div class="form-control-wrap">
                                                <input
                                                    type="text"
                                                    class="form-control @error('duration') error @enderror"
                                                    id="duration"
                                                    name="duration"
                                                    value="{{ old('duration') }}"
                                                    placeholder="Saisir la duree du cours"
                                                    required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="form-label" for="startDate">Date de debut</label>
                                            <div class="form-control-wrap">
                                                <input
                                                    type="text"
                                                    class="form-control date-picker-alt @error('startDate') error @enderror"
                                                    id="startDate"
                                                    name="startDate"
                                                    value="{{ old('startDate') }}"
                                                    data-date-format="yyyy-mm-dd"
                                                    placeholder="Choisir la date de debut"
                                                    required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="form-label" for="endDate">Date de fin</label>
                                            <div class="form-control-wrap">
                                                <input
                                                    type="text"
                                                    class="form-control date-picker-alt @error('endDate') error @enderror"
                                                    id="endDate"
                                                    name="endDate"
                                                    value="{{ old('endDate') }}"
                                                    data-date-format="yyyy-mm-dd"
                                                    placeholder="Choisir la date de fin"
                                                    required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="form-label" for="subDescription">Sous description</label>
                                            <div class="form-control-wrap">
                                                <textarea
                                                    class="form-control form-control-sm @error('subDescription') error @enderror"
                                                    id="subDescription"
                                                    name="subDescription"
                                                    placeholder="Write the description"
                                                >{{ old('subDescription') }}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="form-label" for="description">Description</label>
                                            <div class="form-control-wrap">
                                                <textarea
                                                    class="form-control form-control-sm @error('description') error @enderror"
                                                    id="description"
                                                    name="description"
                                                    placeholder="Write the description"
                                                >{{ old('description') }}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-md btn-primary">Save Informations</button>
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
@endsection
