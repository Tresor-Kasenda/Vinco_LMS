@extends('backend.layout.base')

@section('title', "Creation de filiaire")

@section('content')
    <div class="container-fluid">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="nk-block-head nk-block-head-sm">
                    <div class="nk-block-between">
                        <div class="nk-block-head-content">
                            <h3 class="nk-block-title page-title">Create filiaire</h3>
                        </div>
                        <div class="nk-block-head-content">
                            <div class="toggle-wrap nk-block-tools-toggle">
                                <div class="toggle-expand-content" data-content="more-options">
                                    <ul class="nk-block-tools g-3">
                                        <li class="nk-block-tools-opt">
                                            <a class="btn btn-dim btn-primary btn-sm" href="{{ route('admins.academic.filiaire.index') }}">
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
                            <div class="row justify-content-center">
                                <div class="col-md-6">
                                    <form action="{{ route('admins.academic.filiaire.store') }}" method="post" class="form-validate" enctype="multipart/form-data">
                                        @csrf
                                        <div class="row g-gs">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label class="form-label" for="name">Nom</label>
                                                    <div class="form-control-wrap">
                                                        <input
                                                            type="text"
                                                            class="form-control @error('name') error @enderror"
                                                            id="name"
                                                            name="name"
                                                            value="{{ old('name') }}"
                                                            placeholder="Saisir le nom du filiaire"
                                                            required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label class="form-label" for="images">Logo du Department</label>
                                                    <div class="form-control-wrap">
                                                        <input
                                                            type="file"
                                                            class="form-control @error('images') error @enderror"
                                                            id="images"
                                                            name="images"
                                                            value="{{ old('images') }}"
                                                            placeholder="Choisir le logo du campus"
                                                            required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label class="form-label" for="user">Choisir le responsable</label>
                                                    <select
                                                        class="form-control js-select2 @error('user') error @enderror"
                                                        id="user"
                                                        name="user"
                                                        data-placeholder="Choisir le responsable"
                                                        required>
                                                        <option label="Choisir le responsable" value=""></option>
                                                        @foreach(\App\Models\User::where('role_id', \App\Enums\RoleEnum::CHEF_COURSES)->get() as $user)
                                                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label class="form-label" for="department">Choisir le departement</label>
                                                    <select
                                                        class="form-control js-select2 @error('department') error @enderror"
                                                        id="department"
                                                        name="department"
                                                        data-placeholder="Choisir la departemen"
                                                        required>
                                                        <option label="Choisir le departement" value=""></option>
                                                        @foreach(\App\Models\Department::all() as $campus)
                                                            <option value="{{ $campus->id }}">{{ $campus->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label class="form-label" for="academic">Choisir l'annnee academique</label>
                                                    <select
                                                        class="form-control js-select2 @error('academic') error @enderror"
                                                        id="academic"
                                                        name="academic"
                                                        data-placeholder="Choisir l'annnee academique"
                                                        required>
                                                        <option label="Choisir l'annnee academique" value=""></option>
                                                        @foreach(\App\Models\AcademicYear::all() as $campus)
                                                            <option value="{{ $campus->id }}">{{ $campus->startDate }}/{{ $campus->endDate }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label class="form-label" for="description">Message</label>
                                                    <div class="form-control-wrap">
                                                <textarea
                                                    class="form-control form-control-sm"
                                                    id="description"
                                                    name="description"
                                                    placeholder="Write the description"
                                                >{{ old('description') }}</textarea>
                                                    </div>
                                                </div>
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
