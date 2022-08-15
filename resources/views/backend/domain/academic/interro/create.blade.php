@extends('backend.layout.base')

@section('title')
    Interrogation Create
@endsection

@section('content')
    <div class="container-fluid">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="nk-block-head nk-block-head-sm">
                    <div class="nk-block-between">
                        <div class="nk-block-head-content">
                            <h3 class="nk-block-title page-title">Creation de l'Interrogation</h3>
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
                                    <form action="{{ route('admins.academic.interro.store') }}" method="post" class="form-validate" novalidate="novalidate">
                                        @csrf
                                        <div class="row g-gs">
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

                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="form-label" for="rating">Cote</label>
                                                    <div class="form-control-wrap">
                                                        <input
                                                            type="text"
                                                            class="form-control @error('rating') error @enderror"
                                                            id="rating"
                                                            name="rating"
                                                            value="{{ old('rating') }}"
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
                                                            value="{{ old('duration') }}"
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
                                                            value="{{ old('date') }}"
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
        })
    </script>
@endsection
