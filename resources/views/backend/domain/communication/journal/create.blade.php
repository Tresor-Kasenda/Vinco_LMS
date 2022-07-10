@extends('backend.layout.communication')

@section('title')
    Create Courses
@endsection

@section('content')
    <div class="container-fluid">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="nk-block-head nk-block-head-sm">
                    <div class="nk-block-between">
                        <div class="nk-block-head-content">
                            <h3 class="nk-block-title page-title">Create</h3>
                        </div>
                        <div class="nk-block-head-content">
                            <div class="toggle-wrap nk-block-tools-toggle">
                                <div class="toggle-expand-content" data-content="more-options">
                                    <ul class="nk-block-tools g-3">
                                        <li class="nk-block-tools-opt">
                                            <a class="btn btn-outline-light d-none d-md-inline-flex"
                                               href="{{ route('admins.communication.journal.index') }}">
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
                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                                <div class="col-md-6">
                                    <form action="{{ route('admins.communication.journal.store') }}" method="post" class="form-validate" enctype="multipart/form-data">
                                        @csrf
                                        <div class="row g-gs">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label class="form-label" for="title">Cours</label>
                                                    <div class="form-control-wrap">
                                                        <select name="course_id"
                                                                class="form-control"
                                                                id="course_id">
                                                            @forelse(\App\Models\Course::all() as $cours)
                                                                <option value="{{$cours->id}}">{{$cours->name}}</option>
                                                            @empty
                                                                <option value="">No Course</option>
                                                            @endforelse
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label class="form-label" for="title">Lecon</label>
                                                    <div class="form-control-wrap">
                                                        <input
                                                            type="text"
                                                            class="form-control @error('title') error @enderror"
                                                            id="title"
                                                            name="title"
                                                            value="{{ old('title') }}"
                                                            placeholder="Enter title"
                                                            required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label class="form-label" for="start_date">Start Date/Hours</label>
                                                    <div class="form-control-wrap">
                                                        <input
                                                            type="datetime-local"
                                                            class="form-control @error('start_date') error @enderror"
                                                            id="start_date"
                                                            name="start_date"
                                                            data-date-format="yyyy-mm-dd H:i:s"
                                                            value="{{ old('start_date') }}"
                                                            placeholder="Select Admission Date"
                                                            required>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label class="form-label" for="end_date">End Date/Hours</label>
                                                    <div class="form-control-wrap">
                                                        <input
                                                            type="datetime-local"
                                                            class="form-control @error('end_date') error @enderror"
                                                            id="end_date"
                                                            name="end_date"
                                                            data-date-format="yyyy-mm-dd H:i:s"
                                                            value="{{ old('end_date') }}"
                                                            placeholder="Select Admission Date"
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
