@extends('backend.layout.base')

@section('title', "Creation des exercice")

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
                                <div class="col-md-7">
                                    <form action="{{ route('admins.academic.exercice.store') }}" method="post" class="form-validate" novalidate="novalidate">
                                        @csrf
                                        <div class="row g-gs">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label class="form-label" for="name">Titre du l'exercice</label>
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
                                                        required>
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
                                                        required>
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
                                                        required>
                                                        <option label="Choisir la lesson" value=""></option>
                                                        @foreach(\App\Models\Lesson::all() as $campus)
                                                            <option value="{{ $campus->id }}">{{ $campus->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="form-label" for="date">Date</label>
                                                    <div class="form-control-wrap">
                                                        <input
                                                            type="date"
                                                            class="form-control ql-picker @error('date') error @enderror"
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
                                                    <label class="form-label" for="duration">Duree</label>
                                                    <div class="form-control-wrap">
                                                        <input
                                                            type="text"
                                                            class="form-control @error('duration') error @enderror"
                                                            id="duration"
                                                            name="duration"
                                                            value="{{ old('duration') }}"
                                                            placeholder="Saisir la duree"
                                                            required>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="form-label" for="weighting">Ponderation</label>
                                                    <div class="form-control-wrap">
                                                        <input
                                                            type="text"
                                                            class="form-control @error('weighting') error @enderror"
                                                            id="weighting"
                                                            name="weighting"
                                                            value="{{ old('weighting') }}"
                                                            placeholder="Saisir la ponderation"
                                                            required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="form-label" for="condition">Condition</label>
                                                    <div class="form-control-wrap">
                                                        <input
                                                            type="text"
                                                            class="form-control @error('condition') error @enderror"
                                                            id="condition"
                                                            name="condition"
                                                            value="{{ old('condition') }}"
                                                            placeholder="Saisir la condition"
                                                            required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label class="form-label" for="schedule">Date de depot</label>
                                                    <div class="form-control-wrap">
                                                        <input
                                                            type="datetime-local"
                                                            class="form-control @error('schedule') error @enderror"
                                                            id="schedule"
                                                            name="schedule"
                                                            value="{{ old('schedule') }}"
                                                            placeholder="Saisir la date de depot"
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
