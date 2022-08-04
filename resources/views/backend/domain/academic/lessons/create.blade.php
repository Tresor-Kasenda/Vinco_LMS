@extends('backend.layout.base')

@section('title')
    Create Lesson
@endsection

@section('content')
    <div class="container-fluid">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="nk-block">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h6 class="card-title mt-2">Creation des lecon</h6>
                            <a class="btn btn-dim btn-primary btn-sm  active-link mt-2" href="{{ route('admins.academic.lessons.index') }}">
                                <em class="icon ni ni-arrow-left"></em>
                                <span>Back</span>
                            </a>
                        </div>
                        <div class="card-body">
                            <div class="row justify-content-center">
                                <div class="col-md-10 mt-4">
                                    @if ($errors->any())
                                        <div class="alert alert-danger">
                                            <ul>
                                                @foreach ($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif
                                    <form action="{{ route('admins.academic.lessons.store') }}" method="post" class="form-validate" novalidate="novalidate">
                                        @csrf
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
                                                            value="{{ old('name') }}"
                                                            placeholder="Saisir le nom du cours"
                                                            required>
                                                    </div>
                                                </div>
                                            </div>
                                            @php
                                                if (auth()->user()->hasRole('Super Admin')) {
                                                    $types = \App\Models\LessonType::query()
                                                        ->select(['id', 'name'])
                                                        ->get();

                                                    $chapters = \App\Models\Chapter::query()
                                                        ->select(['id', 'name', 'course_id'])
                                                        ->with('course')
                                                        ->get();
                                                } else {
                                                    $types = \App\Models\LessonType::query()
                                                        ->select(['id', 'name'])
                                                        ->get();

                                                    $chapters = \App\Models\Chapter::query()
                                                        ->select(['id', 'name', 'course_id'])
                                                        ->with('course')
                                                        ->whereHas('course', function ($builder) {
                                                            $builder->where('institution_id', auth()->user()->institution->id);
                                                        })
                                                        ->get();
                                                }
                                            @endphp

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
                                                        <option label="Select Type" value=""></option>
                                                        @foreach($types as $type)
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
                                                        <option label="Select chapter" value=""></option>
                                                        @foreach($chapters as $chapter)
                                                            <option value="{{ $chapter->id }}">
                                                                {{ $chapter->name }} / (<small>{{ ucfirst($chapter->course->name) ?? "" }}</small>)
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div id="aperi">
                                                <span class="preview-title-lg overline-title">Aperi</span>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="form-label" for="name"></label>
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
                                                        <label class="form-label" for="name"></label>
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
                                            </div>

                                            <div class="col-md-12" id="text">
                                                <div class="form-group">
                                                    <label class="form-label" for="content">Contenue</label>
                                                    <div class="form-control-wrap">
                                                        <textarea
                                                            class="form-control form-control-sm @error('content') error @enderror"
                                                            id="content"
                                                            name="content"
                                                            rows="5"
                                                            placeholder="Write the description"
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
    <script>
        $(document).ready(function () {
            $("#text").hide();
            $("#aperi").hide();
            $('#type').change(function () {
                let type = $(this).val();
                if (type == 1){
                    $("#text").hide();
                    $("#aperi").hide();
                } else if (type == 2) {
                    $("#text").hide();
                    $("#aperi").show();
                } else if (type == 3) {
                    $("#text").show();
                    $("#aperi").hide();
                } else if (type == 4) {
                    $("#text").hide();
                    $("#aperi").hide();
                }
            });
        })
    </script>
@endsection
