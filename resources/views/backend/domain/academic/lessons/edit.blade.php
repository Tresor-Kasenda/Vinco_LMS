@extends('backend.layout.base')

@section('title', "Mise a jours du lecon")

@section('content')
    <div class="container-fluid">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="nk-block">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h6 class="card-title mt-2">Update lecon</h6>
                            <a class="btn btn-dim btn-primary btn-sm  active-link mt-2" href="{{ route('admins.academic.lessons.index') }}">
                                <em class="icon ni ni-arrow-left"></em>
                                <span>Back</span>
                            </a>
                        </div>
                        <div class="card-body">
                            <div class="row justify-content-center">
                                <div class="col-md-7">
                                    <form action="{{ route('admins.academic.lessons.update', $lesson->key) }}" method="post" class="form-validate" novalidate="novalidate">
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
                                                            placeholder="Saisir le nom du cours"
                                                            required>
                                                    </div>
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
                                                        <option label="Choisir le chapter" value=""></option>
                                                        @foreach(\App\Models\Chapter::all() as $campus)
                                                            <option value="{{ $campus->id }}">{{ $campus->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label class="form-label" for="short_content">Sous contenue</label>
                                                    <div class="form-control-wrap">
                                                        <textarea
                                                            class="form-control form-control-sm @error('short_content') error @enderror"
                                                            id="short_content"
                                                            name="short_content"
                                                            placeholder="Write the description"
                                                        >{{ old('short_content') ?? $lesson->shortContent }}</textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label class="form-label" for="content">Contenue</label>
                                                    <div class="form-control-wrap">
                                                        <textarea
                                                            class="form-control form-control-sm @error('content') error @enderror"
                                                            id="content"
                                                            name="content"
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
