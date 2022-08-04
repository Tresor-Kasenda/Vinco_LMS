@extends('backend.layout.base')

@section('title')
    Create Exams List
@endsection

@section('content')
    <div class="container-fluid">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="nk-block-head nk-block-head-sm">
                    <div class="nk-block-between">
                        <div class="nk-block-head-content">
                            <h3 class="nk-block-title page-title">Create Exams</h3>
                        </div>
                        <div class="nk-block-head-content">
                            <div class="toggle-wrap nk-block-tools-toggle">
                                <div class="toggle-expand-content" data-content="more-options">
                                    <ul class="nk-block-tools g-3">
                                        <li class="nk-block-tools-opt">
                                            <a class="btn btn-dim btn-primary btn-sm" href="{{ route('admins.exam.exam.index') }}">
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
                                    <form action="{{ route('admins.exam.exam.store') }}" method="post" class="form-validate mt-4" novalidate="novalidate">
                                        @csrf
                                        <div class="row g-gs">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label class="form-label" for="course">Cours</label>
                                                    <div class="form-control-wrap">
                                                        <select
                                                            class="form-control js-select2  select2-hidden-accessible @error('course') error @enderror"
                                                            data-value="{{ old('course') }}"
                                                            data-search="on"
                                                            id="course"
                                                            name="course"
                                                            data-placeholder="Select a course"
                                                            required>
                                                            <option label="Choisir une course" value=""></option>
                                                            @foreach(\App\Models\Course::all() as $course)
                                                                <option value="{{ $course->id }}">
                                                                    {{ ucfirst($course->name) ?? "" }}
                                                                </option>
                                                            @endforeach>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label class="form-label" for="exam_session">Session Examen</label>
                                                    <div class="form-control-wrap">
                                                        <select
                                                            class="form-control js-select2  select2-hidden-accessible @error('exam_session') error @enderror"
                                                            data-value="{{ old('exam_session') }}"
                                                            data-search="on"
                                                            id="exam_session"
                                                            name="exam_session"
                                                            data-placeholder="Select Session exam"
                                                            required>
                                                            <option label="Choisir une course" value=""></option>
                                                            @foreach(\App\Models\ExamSession::all() as $exam_session)
                                                                <option value="{{ $exam_session->id }}">
                                                                    {{ ucfirst($exam_session->name) ?? "" }}
                                                                </option>
                                                            @endforeach>
                                                        </select>
                                                    </div>
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
                                                            placeholder="Saisir la ponderation"
                                                            required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label class="form-label" for="date">Date</label>
                                                    <div class="form-control-wrap">
                                                        <input
                                                            type="text"
                                                            class="form-control date-picker @error('date') error @enderror"
                                                            id="date"
                                                            name="date"
                                                            data-date-format="yyyy-mm-dd"
                                                            value="{{ old('date') }}"
                                                            placeholder="Selectionnez la date"
                                                            required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label class="form-label" for="start_time">Heure de debut</label>
                                                    <div class="form-control-wrap">
                                                        <input
                                                            type="text"
                                                            class="form-control time-picker @error('start_time') error @enderror"
                                                            id="start_time"
                                                            name="start_time"
                                                            value="{{ old('start_time') }}"
                                                            placeholder="Select Start Time"
                                                            required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label class="form-label" for="duration">Durée d'examen</label>
                                                    <div class="form-control-wrap">
                                                        <input
                                                            type="text"
                                                            class="form-control @error('duration') error @enderror"
                                                            id="duration"
                                                            name="duration"
                                                            value="{{ old('duration') }}"
                                                            placeholder="Saisir la durée d'examen"
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
