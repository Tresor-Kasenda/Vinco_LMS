@extends('backend.layout.base')

@section('title', "Mise a jours du devoir")

@section('content')
    <div class="container-fluid">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="nk-block-head nk-block-head-sm">
                    <div class="nk-block-between">
                        <div class="nk-block-head-content">
                            <h3 class="nk-block-title page-title">Edition du TP</h3>
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
                                    <form action="{{ route('admins.academic.homework.update', $homework->id) }}" method="post" class="form-validate" novalidate="novalidate">
                                        @csrf
                                        @method('PUT')
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
                                                            value="{{ old('name') ?? $homework->name }}"
                                                            placeholder="Enter Homework Name"
                                                            required>
                                                    </div>
                                                </div>
                                            </div>

                                            @php
                                                if (auth()->user()->hasRole('Super Admin')) {
                                                    $courses = \App\Models\Course::query()
                                                        ->select([
                                                            'id',
                                                            'name',
                                                            'institution_id'
                                                        ])
                                                        ->with('institution:id,institution_name')
                                                        ->get();
                                                } else {
                                                    $courses = \App\Models\Course::query()
                                                        ->select([
                                                            'id',
                                                            'name',
                                                            'institution_id'
                                                        ])
                                                        ->where('institution_id', '=', auth()->user()->institution->id)
                                                        ->get();
                                                }
                                            @endphp

                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label class="form-label" for="course">Cours</label>
                                                    <select
                                                        class="form-control js-select2 select2-hidden-accessible @error('course') error @enderror"
                                                        id="course"
                                                        data-search="on"
                                                        name="course"
                                                        data-placeholder="Choisir le course"
                                                    >
                                                        <option label="Choisir le course" value=""></option>
                                                        @foreach($courses as $course)
                                                            <option value="{{ $course->id }}">
                                                                {{ ucfirst($course->name) ?? ""}}
                                                                @if(auth()->user()->hasRole('Super Admin'))
                                                                    / (<small>{{ ucfirst($course->institution->institution_name) ?? "" }}</small>)
                                                                @endif
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label class="form-label" for="chapter">Chapitre</label>
                                                    <select
                                                        class="form-control js-select2 select2-hidden-accessible @error('chapter') error @enderror"
                                                        id="chapter"
                                                        data-search="on"
                                                        name="chapter"
                                                        data-placeholder="Choisir le chapter"
                                                    >

                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label class="form-label" for="lesson">Lecon</label>
                                                    <select
                                                        class="form-control js-select2 select2-hidden-accessible @error('lesson') error @enderror"
                                                        id="lesson"
                                                        data-search="on"
                                                        name="lesson"
                                                        data-placeholder="Choisir la lesson"
                                                    >

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
                                                            value="{{ old('rating') ?? $homework->rating_homework }}"
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
                                                            value="{{ old('date') ?? $homework->filling_date }}"
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


@section('scripts')
    <script>
        $(document).ready(function () {
            $('#course').change(function () {
                let course = $(this).val();
                if (course){
                    $.ajax({
                        type:'GET',
                        url:'{{ route("admins.academic.chapter-json") }}',
                        data:{"course" : course },
                        success:function(response) {
                            $("#chapter").empty();
                            $("#chapter").append('<option label="Select Chapter" value=""></option>');
                            if(response && response?.status === 'success') {
                                response?.chapters?.map((chapitre) => {
                                    $("#chapter").append('<option value="'+chapitre.id+'">'+chapitre.name+'</option>');
                                })
                            }
                        }
                    })
                }
            });

            $('#chapter').change(function () {
                let chapter = $(this).val();
                if(chapter){
                    $.ajax({
                        type:"GET",
                        url:"{{ route('admins.academic.lesson-json') }}",
                        data : { "chapter" : chapter },
                        success:function(response){
                            $("#lesson").empty();
                            $("#lesson").append('<option label="Select lessons" value=""></option>');
                            if(response && response?.status === 'success'){
                                response?.lessons?.map((lesson) => {
                                    $("#lesson").append('<option value="'+lesson.id+'">'+lesson.name+'</option>');
                                })
                            }
                        }
                    });
                }
            })
        })
    </script>
@endsection

