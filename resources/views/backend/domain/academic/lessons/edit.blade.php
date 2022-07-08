@extends('backend.layout.base')

@section('title')
    Edit Lessons
@endsection

@section('content')
    <div class="container-fluid">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="nk-block">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h6 class="card-title mt-2">Edit Leçon</h6>
                            <a class="btn btn-dim btn-primary btn-sm  active-link mt-2" href="{{ route('admins.academic.lessons.index') }}">
                                <em class="icon ni ni-arrow-left"></em>
                                <span>Back</span>
                            </a>
                        </div>
                        <div class="card-body">
                            <div class="row justify-content-center">
                                <div class="col-md-7 mt-4">
                                    <form action="{{ route('admins.academic.lessons.update', $lesson->id) }}" method="post" class="form-validate" novalidate="novalidate">
                                        @csrf
                                        @method('PUT')
                                        <div class="row g-gs">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label class="form-label" for="name">Titre du lecon</label>
                                                    <div class="form-control-wrap">
                                                        <input
                                                            type="text"
                                                            class="form-control @error('name') error @enderror"
                                                            id="name"
                                                            name="name"
                                                            value="{{ old('name') ?? $lesson->name }}"
                                                            placeholder="Enter Lesson title"
                                                            required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label class="form-label" for="type">Type</label>
                                                    <select
                                                        class="form-control js-select2 select2-hidden-accessible @error('type') error @enderror"
                                                        data-search="on"
                                                        id="type"
                                                        name="type"
                                                        data-placeholder="Select Type"
                                                        required>
                                                        <option value="{{ $lesson->type->id }}">{{ ucfirst($lesson->type->name) }}</option>
                                                        @foreach(\App\Models\LessonType::all() as $type)
                                                            <option value="{{ $type->id }}">{{ $type->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label class="form-label" for="chapter">Chapitre</label>
                                                    <select
                                                        class="form-control js-select2 select2-hidden-accessible @error('chapter') error @enderror"
                                                        data-search="on"
                                                        id="chapter"
                                                        name="chapter"
                                                        data-placeholder="Select chapter"
                                                        required>
                                                        <option value="{{ $lesson->chapter->id }}">{{ ucfirst($lesson->chapter->name) }}</option>
                                                        @foreach(\App\Models\Chapter::all() as $campus)
                                                            <option value="{{ $campus->id }}">{{ $campus->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-md-12" id="text">
                                                <div class="form-group">
                                                    <label class="form-label" for="content">Contenue</label>
                                                    <div class="form-control-wrap">
                                                        <textarea
                                                            class="form-control form-control-sm quill-basic ql-toolbar @error('content') error @enderror"
                                                            id="content"
                                                            name="content"
                                                            rows="5"
                                                            placeholder="Write the description"
                                                        >{{ old('content') ?? $lesson->content }}</textarea>
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

@section('scripts')
    <script src="https://cdn.ckeditor.com/ckeditor5/23.0.0/classic/ckeditor.js"></script>
    <script>
        ClassicEditor
            .create(document.querySelector('#content'), {
            })
            .catch((error) => {
                console.log(error)
            })
    </script>
@endsection
