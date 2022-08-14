@php use App\Models\Chapter; @endphp
@extends('backend.layout.base')

@section('title')
    Create Resource
@endsection

@section('content')
    <div class="container-fluid">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="nk-block">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h6 class="card-title mt-2">Create Resource</h6>
                            <a class="btn btn-dim btn-primary btn-sm  active-link mt-2" href="{{ route('admins.academic.resource.index') }}">
                                <em class="icon ni ni-arrow-left"></em>
                                <span>Back</span>
                            </a>
                        </div>
                        <div class="card-body">
                            <div class="row justify-content-center">
                                <div class="col-md-6">
                                    <form action="{{ route('admins.academic.resource.store') }}" method="post" class="form-validate" novalidate="novalidate" enctype="multipart/form-data">
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
                                                            placeholder="Enter name of Resource"
                                                            required>
                                                    </div>
                                                </div>
                                            </div>
                                            @php
                                                if (auth()->user()->hasRole('Super Admin')) {
                                                    $chapters = \App\Models\Chapter::query()
                                                            ->select([
                                                                'id',
                                                                'name'
                                                            ])
                                                            ->with('course')
                                                            ->get();
                                                } else {
                                                    $chapters = \App\Models\Chapter::query()
                                                            ->select([
                                                                'id',
                                                                'name'
                                                            ])
                                                            ->whereHas('course', function ($query) {
                                                                $query->where('institution_id', auth()->user()->institution->id);
                                                            })
                                                            ->get();
                                                }
                                            @endphp
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label class="form-label" for="chapter">Chapitre</label>
                                                    <select
                                                        class="form-control js-select2 select2-hidden-accessible @error('chapter') error @enderror"
                                                        id="chapter"
                                                        data-search="on"
                                                        name="chapter"
                                                        data-placeholder="Select Chapter"
                                                        required>
                                                        <option label="Choisir le lesson" value=""></option>
                                                        @foreach($chapters as $chapter)
                                                            <option value="{{ $chapter->id }}">{{ ucfirst($chapter->name) }}</option>
                                                        @endforeach
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
                                                        data-placeholder="Select Lesson"
                                                        required>

                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label class="form-label" for="files">Fichier</label>
                                                    <div class="form-control-wrap">
                                                        <input
                                                            type="file"
                                                            class="form-control @error('files') error @enderror"
                                                            id="files"
                                                            name="files"
                                                            value="{{ old('files') }}"
                                                            placeholder="Saisir le nom du cours"
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
            $('#chapter').change(function () {
                let chapter = $(this).val();
                if (chapter){
                    $.ajax({
                        type:'GET',
                        url:'{{ route("admins.academic.lesson-json") }}',
                        data:{"chapter" : chapter },
                        success:function(response){
                            $("#lesson").empty();
                            $("#lesson").append('<option label="Select Lesson" value=""></option>');
                            if(response && response?.status === 'success'){
                                response?.lessons?.map((lesson) => {
                                    $("#lesson").append('<option value="'+lesson.id+'">'+lesson.name+'</option>');
                                })
                            }
                        }
                    })
                }
            });
        })
    </script>
@endsection

