@extends('backend.layout.base')

@section('title', "Mise a jours des exercice")

@section('content')
    <div class="container-fluid">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="nk-block">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h6 class="card-title mt-2">Edit d'exercice</h6>
                            <a class="btn btn-dim btn-primary btn-sm  active-link mt-2" href="{{ route('admins.academic.exercice.index') }}">
                                <em class="icon ni ni-arrow-left"></em>
                                <span>Back</span>
                            </a>
                        </div>
                        <div class="card-body">
                            <div class="row justify-content-center">
                                <div class="col-md-7">
                                    @if ($errors->any())
                                        <div class="alert alert-danger">
                                            <ul>
                                                @foreach ($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif
                                    <form action="{{ route('admins.academic.exercice.update', $exercise->id) }}" method="post" class="form-validate" novalidate="novalidate">
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
                                                            value="{{ old('name') ?? $exercise->name }}"
                                                            placeholder="Saisir le nom du cours"
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

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="form-label" for="date">Date Depot</label>
                                                    <div class="form-control-wrap">
                                                        <input
                                                            type="date"
                                                            class="form-control datepicker @error('date') error @enderror"
                                                            id="date"
                                                            name="date"
                                                            value="{{ old('date') ?? $exercise->filling_date }}"
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
                                                            value="{{ old('rating') ?? $exercise->rating }}"
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

