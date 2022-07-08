@extends('backend.layout.base')

@section('title')
    Exercice Create
@endsection

@section('content')
    <div class="container-fluid">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="nk-block">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h6 class="card-title mt-2">Creation d'exercice</h6>
                            <a class="btn btn-dim btn-primary btn-sm  active-link mt-2" href="{{ route('admins.academic.exercice.index') }}">
                                <em class="icon ni ni-arrow-left"></em>
                                <span>Back</span>
                            </a>
                        </div>
                        <div class="card-body">
                            <div class="row justify-content-center">
                                <div class="col-md-6">
                                    <form action="{{ route('admins.academic.exercice.store') }}" method="post" class="form-validate" novalidate="novalidate">
                                        @csrf
                                        <div class="row g-gs">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label class="form-label" for="name">Titre</label>
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
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label class="form-label" for="course">Cours</label>
                                                    <select
                                                        class="form-control js-select2 @error('course') error @enderror"
                                                        id="course"
                                                        name="course"
                                                        data-placeholder="Choisir le course"
                                                        >
                                                        <option label="Choisir le course" value=""></option>
                                                        @foreach(\App\Models\Course::all() as $campus)
                                                            <option value="{{ $campus->id }}">{{ $campus->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label class="form-label" for="chapter">Chapitre</label>
                                                    <select
                                                        class="form-control js-select2 @error('chapter') error @enderror"
                                                        id="chapter"
                                                        name="chapter"
                                                        data-placeholder="Choisir le chapter"
                                                        >
                                                        <option label="Choisir le chapter" value=""></option>
                                                        @foreach(\App\Models\Chapter::all() as $campus)
                                                            <option value="{{ $campus->id }}">{{ $campus->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label class="form-label" for="lesson">Lecon</label>
                                                    <select
                                                        class="form-control js-select2 @error('lesson') error @enderror"
                                                        id="lesson"
                                                        name="lesson"
                                                        data-placeholder="Choisir la lesson"
                                                        >
                                                        <option label="Choisir la lesson" value=""></option>
                                                        @foreach(\App\Models\Lesson::all() as $campus)
                                                            <option value="{{ $campus->id }}">{{ $campus->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="form-label" for="date">Date Depot</label>
                                                    <div class="form-control-wrap">
                                                        <input
                                                            type="date"
                                                            class="form-control datepicker @error('date') error @enderror"
                                                            id="date"
                                                            name="date"
                                                            value="{{ old('date') }}"
                                                            placeholder="Saisir la date"
                                                            required>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="form-label" for="rating">Cotation</label>
                                                    <div class="form-control-wrap">
                                                        <input
                                                            type="text"
                                                            class="form-control @error('rating') error @enderror"
                                                            id="rating"
                                                            name="rating"
                                                            value="{{ old('rating') }}"
                                                            placeholder="Saisir la cotation"
                                                            required>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-12 mb-3">
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
