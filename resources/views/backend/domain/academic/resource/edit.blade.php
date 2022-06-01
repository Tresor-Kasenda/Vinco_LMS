@extends('backend.layout.base')

@section('title', "Mise a jours de resource")

@section('content')
    <div class="container-fluid">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="nk-block-head nk-block-head-sm">
                    <div class="nk-block-between">
                        <div class="nk-block-head-content">
                            <h3 class="nk-block-title page-title">Edition du lecon ({{ $lesson->name }} )</h3>
                        </div>
                        <div class="nk-block-head-content">
                            <div class="toggle-wrap nk-block-tools-toggle">
                                <div class="toggle-expand-content" data-content="more-options">
                                    <ul class="nk-block-tools g-3">
                                        <li class="nk-block-tools-opt">
                                            <a class="btn btn-dim btn-primary btn-sm" href="{{ route('admins.academic.resource.index') }}">
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
                            <div class="row">
                                <div class="col-md-6">
                                    <form action="{{ route('admins.academic.resource.update', ['resource' => $lesson->key]) }}" method="post" class="form-validate" novalidate="novalidate" enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')
                                        <div class="row g-gs">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label class="form-label" for="name">Nom du Leçon</label>
                                                    <div class="form-control-wrap">
                                                        <input
                                                            type="text"
                                                            class="form-control @error('name') error @enderror"
                                                            id="name"
                                                            name="name"
                                                            value="{{ old('name') ?? $lesson->name }}"
                                                            placeholder="Saisir le nom du Leçon"
                                                            required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label class="form-label" for="shortContent">Bref contenue</label>
                                                    <div class="form-control-wrap">
                                                        <input
                                                            type="text"
                                                            class="form-control @error('shortContent') error @enderror"
                                                            id="shortContent"
                                                            name="shortContent"
                                                            value="{{ old('shortContent') ?? $lesson->shortContent }}"
                                                            placeholder="une breve contenue"
                                                            required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label class="form-label" for="chapter">Nom du cours</label>
                                                    <div class="form-control-wrap">
                                                        <input
                                                            type="text"
                                                            class="form-control @error('chapter') error @enderror"
                                                            id="chapter"
                                                            name="chapter"
                                                            value="{{ old('chapter') ?? $chapter->name }}"
                                                            placeholder="Nom du leçon"
                                                            required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label class="form-label" for="chapter">Nom du chapitre</label>
                                                    <div class="form-control-wrap">
                                                        <input
                                                            type="text"
                                                            class="form-control @error('chapter') error @enderror"
                                                            id="chapter"
                                                            name="chapter"
                                                            value="{{ old('chapter') ?? $chapter->name }}"
                                                            placeholder="Nom du leçon"
                                                            required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label class="form-label" for="content">Contenue du Leçon</label>
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
