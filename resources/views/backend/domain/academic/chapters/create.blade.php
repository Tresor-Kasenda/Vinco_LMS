@extends('backend.layout.base')

@section('title')
    Create Chapter
@endsection

@section('content')
    <div class="container-fluid">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="nk-block">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h6 class="card-title mt-2">Creation des chapitre</h6>
                            <a class="btn btn-dim btn-primary btn-sm  active-link mt-2" href="{{ route('admins.academic.chapter.index') }}">
                                <em class="icon ni ni-arrow-left"></em>
                                <span>Back</span>
                            </a>
                        </div>
                        <div class="card-body">
                            <div class="row justify-content-center">
                                <div class="col-md-8">
                                    <form action="{{ route('admins.academic.chapter.store') }}" method="post" class="form-validate" novalidate="novalidate">
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
                                            @php
                                                if (auth()->user()->hasRole('Super Admin')) {
                                                    $courses = \App\Models\Course::query()
                                                        ->with('institution')
                                                        ->get();
                                                } else {
                                                    $courses = \App\Models\Course::query()
                                                        ->where('institution_id', '=', auth()->user()->institution->id)
                                                        ->get();
                                                }
                                            @endphp
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label class="form-label" for="course">Cours</label>
                                                    <select
                                                        class="form-control js-select2 select2-hidden-accessible @error('course') error @enderror"
                                                        data-search="on"
                                                        id="course"
                                                        name="course"
                                                        data-placeholder="Select Course"
                                                        required>
                                                        <option label="Select Course" value=""></option>
                                                        @foreach($courses as $cours)
                                                            <option value="{{ $cours->id }}">{{ ucfirst($cours->name) ?? "" }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label class="form-label" for="content">Description</label>
                                                    <div class="form-control-wrap">
                                                        <textarea
                                                            class="form-control form-control-sm @error('content') error @enderror"
                                                            id="content"
                                                            name="content"
                                                            placeholder="Write the content"
                                                        >{{ old('content') }}</textarea>
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
    <script src="{{ asset('js/tinymce/tinymce.min.js') }}" referrerpolicy="origin"></script>
    <script>
        tinymce.init({
            selector: 'textarea#content',
            height: 260,
            resize: true,
            max_height: 500,
            icons_url: 'https://www.example.com/icons/material/icons.js',
            icons: 'material',
            mobile: {
                menubar: true,
                plugins: 'autosave lists autolink',
                toolbar: 'undo bold italic styles'
            },
            plugins: [
                'advlist', 'autolink', 'lists', 'link', 'image', 'charmap', 'preview',
                'anchor', 'searchreplace', 'visualblocks', 'code', 'fullscreen',
                'insertdatetime', 'media', 'table', 'help', 'wordcount', 'emoticons'
            ],
            toolbar: 'undo redo | styles | bold italic | ' +
                'alignleft aligncenter alignright alignjustify | ' +
                'outdent indent | numlist bullist | emoticons',

        });
    </script>
@endsection
