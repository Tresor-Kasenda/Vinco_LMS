@extends('backend.layout.base')

@section('title')
    Edit Interro
@endsection

@section('content')
    <div class="container-fluid">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="nk-block-head nk-block-head-sm">
                    <div class="nk-block-between">
                        <div class="nk-block-head-content">
                            <h3 class="nk-block-title page-title">Edition de l'interro</h3>
                        </div>
                        <div class="nk-block-head-content">
                            <div class="toggle-wrap nk-block-tools-toggle">
                                <div class="toggle-expand-content" data-content="more-options">
                                    <ul class="nk-block-tools g-3">
                                        <li class="nk-block-tools-opt">
                                            <a class="btn btn-dim btn-primary btn-sm" href="{{ route('admins.academic.interro.index') }}">
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
                                    <form action="{{ route('admins.academic.interro.update', $interro->id) }}" method="post" class="form-validate" novalidate="novalidate" enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')
                                        <div class="row g-gs">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label class="form-label" for="course">Cours</label>
                                                    <select
                                                        class="form-control js-select2 @error('course') error @enderror"
                                                        id="course"
                                                        name="course"
                                                        data-placeholder="Choisir le cours"
                                                        required>
                                                        <option value="{{ $interro->course->id }}">{{ ucfirst($interro->course->name) }}</option>
                                                        @foreach(\App\Models\Course::all() as $course)
                                                            <option value="{{ $course->id }}">{{ $course->name }}</option>
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
                                                        <option value="{{ $interro->chapter->id }}">{{ ucfirst($interro->chapter->name) }}</option>
                                                        @foreach(\App\Models\Chapter::all() as $chapter)
                                                            <option value="{{ $chapter->id }}">{{ $chapter->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="form-label" for="rating">Cote</label>
                                                    <div class="form-control-wrap">
                                                        <input
                                                            type="text"
                                                            class="form-control @error('rating') error @enderror"
                                                            id="rating"
                                                            name="rating"
                                                            value="{{ old('rating') ?? $interro->rating }}"
                                                            placeholder="Saisir le cote"
                                                            required>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="form-label" for="duration">Duree</label>
                                                    <div class="form-control-wrap">
                                                        <input
                                                            type="time"
                                                            class="form-control @error('duration') error @enderror"
                                                            id="duration"
                                                            name="duration"
                                                            value="{{ old('duration') ?? $interro->duration }}"
                                                            placeholder="Select duration"
                                                            required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="form-label" for="date">Date</label>
                                                    <div class="form-control-wrap">
                                                        <input
                                                            type="date"
                                                            class="form-control @error('date') error @enderror"
                                                            id="date"
                                                            name="date"
                                                            value="{{ old('date') ?? $interro->date }}"
                                                            placeholder="Select Date"
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
