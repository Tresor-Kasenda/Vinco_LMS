@extends('backend.layout.base')

@section('title')
    Create HomeWork
@endsection

@section('content')
    <div class="container-fluid">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="nk-block-head nk-block-head-sm">
                    <div class="nk-block-between">
                        <div class="nk-block-head-content">
                            <h3 class="nk-block-title page-title">Creation du Devoir</h3>
                        </div>
                        <div class="nk-block-head-content">
                            <div class="toggle-wrap nk-block-tools-toggle">
                                <div class="toggle-expand-content" data-content="more-options">
                                    <ul class="nk-block-tools g-3">
                                        <li class="nk-block-tools-opt">
                                            <a class="btn btn-dim btn-primary btn-sm" href="{{ route('admins.academic.homework.index') }}">
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
                                    @if ($errors->any())
                                        <div class="alert alert-danger">
                                            <ul>
                                                @foreach ($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif
                                    <form action="{{ route('admins.academic.homework.store') }}" method="post" class="form-validate" novalidate="novalidate">
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
                                                            placeholder="Enter Homework Name"
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
                                                        @foreach(\App\Models\Course::all() as $cours)
                                                            <option value="{{ $cours->id }}">{{ $cours->name }}</option>
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
                                                        @foreach(\App\Models\Chapter::all() as $chapter)
                                                            <option value="{{ $chapter->id }}">{{ $chapter->name }}</option>
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
                                                        @foreach(\App\Models\Lesson::all() as $lesson)
                                                            <option value="{{ $lesson->id }}">{{ $lesson->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label class="form-label" for="rating">Ponderation</label>
                                                    <div class="form-control-wrap">
                                                        <input
                                                            type="text"
                                                            class="form-control @error('rating') error @enderror"
                                                            id="rating"
                                                            name="rating"
                                                            value="{{ old('rating') }}"
                                                            placeholder="Enter rating"
                                                            required>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label class="form-label" for="date">Date de depot</label>
                                                    <div class="form-control-wrap">
                                                        <input
                                                            type="date"
                                                            class="form-control @error('date') error @enderror"
                                                            id="date"
                                                            name="date"
                                                            value="{{ old('date') }}"
                                                            placeholder="Enter Date"
                                                            required>
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
