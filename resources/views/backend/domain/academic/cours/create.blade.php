@extends('backend.layout.base')

@section('title')
    Create Course
@endsection

@section('content')
    <div class="container-fluid">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="nk-block-head nk-block-head-sm">
                    <div class="nk-block-between">
                        <div class="nk-block-head-content">
                            <h3 class="nk-block-title page-title">Create course</h3>
                        </div>
                        <div class="nk-block-head-content">
                            <div class="toggle-wrap nk-block-tools-toggle">
                                <div class="toggle-expand-content" data-content="more-options">
                                    <ul class="nk-block-tools g-3">
                                        <li class="nk-block-tools-opt">
                                            <a class="btn btn-dim btn-primary btn-sm" href="{{ route('admins.academic.course.index') }}">
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
                                    <form action="{{ route('admins.academic.course.store') }}" method="post" class="form-validate mt-4" novalidate="novalidate" enctype="multipart/form-data">
                                        @csrf
                                        <div class="row g-gs">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label class="form-label" for="name">Nom</label>
                                                    <div class="form-control-wrap">
                                                        <input
                                                            type="text"
                                                            class="form-control @error('name') error @enderror"
                                                            id="name"
                                                            name="name"
                                                            value="{{ old('name') }}"
                                                            placeholder="Enter course name"
                                                            required>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label class="form-label" for="weighting">Ponderation</label>
                                                    <div class="form-control-wrap">
                                                        <input
                                                            type="number"
                                                            class="form-control @error('weighting') error @enderror"
                                                            id="weighting"
                                                            name="weighting"
                                                            value="{{ old('weighting') }}"
                                                            placeholder="Select weighting"
                                                            required>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label class="form-label" for="category">Categorie</label>
                                                    <div class="form-control-wrap">
                                                        <select
                                                            class="form-control  js-select2  select2-hidden-accessible @error('category') error @enderror"
                                                            data-value="{{ old('category') }}"
                                                            data-search="on"
                                                            id="category"
                                                            name="category"
                                                            data-placeholder="Select a category"
                                                            required>
                                                            <option label="Choisir une categorie" value=""></option>
                                                            @foreach(\App\Models\Category::all() as $category)
                                                                <option value="{{ $category->id }}">
                                                                    {{ $category->name ?? "" }}
                                                                </option>
                                                            @endforeach>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label class="form-label" for="professor">Professeur</label>
                                                    <div class="form-control-wrap">
                                                        <select
                                                            class="form-control js-select2  select2-hidden-accessible @error('professor') error @enderror"
                                                            data-value="{{ old('professor') }}"
                                                            data-search="on"
                                                            id="professor"
                                                            name="professor"
                                                            data-placeholder="Select a professor"
                                                            required>
                                                            <option label="Choisir un professeur" value=""></option>
                                                            @foreach(\App\Models\Professor::all() as $professor)
                                                                <option value="{{ $professor->id }}">
                                                                    {{ ucfirst($professor->username) ?? "" }}
                                                                </option>
                                                            @endforeach>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label class="form-label" for="images">Images</label>
                                                    <div class="form-control-wrap">
                                                        <input
                                                            type="file"
                                                            class="form-control @error('images') error @enderror"
                                                            id="images"
                                                            name="images"
                                                            value="{{ old('images') }}"
                                                            placeholder="Select Images"
                                                            required>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label class="form-label" for="sub_description">Sous description</label>
                                                    <div class="form-control-wrap">
                                                        <textarea
                                                            class="form-control form-control-sm @error('sub_description') error @enderror"
                                                            id="sub_description"
                                                            name="sub_description"
                                                            rows="2"
                                                            placeholder="Write the description"
                                                        >{{ old('sub_description') }}</textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label class="form-label" for="description">Description</label>
                                                    <div class="form-control-wrap">
                                                        <textarea
                                                            class="form-control form-control-sm @error('description') error @enderror"
                                                            id="description"
                                                            name="description"
                                                            placeholder="Write the description"
                                                        >{{ old('description') }}</textarea>
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
