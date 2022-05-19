@extends('backend.layout.base')

@section('title', "Administration")

@section('content')
    <div class="container-fluid">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="nk-block-head nk-block-head-sm">
                    <div class="nk-block-between">
                        <div class="nk-block-head-content">
                            <h3 class="nk-block-title page-title">Annee academique</h3>
                        </div>
                        <div class="nk-block-head-content">
                            <div class="toggle-wrap nk-block-tools-toggle">
                                <div class="toggle-expand-content" data-content="more-options">
                                    <ul class="nk-block-tools g-3">
                                        <li class="nk-block-tools-opt">
                                            <a class="btn btn-outline-light d-none d-md-inline-flex" href="{{ route('admins.categories.index') }}">
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
                            <form action="{{ route('admins.categories.store') }}" method="post" class="form-validate" novalidate="novalidate">
                                @csrf
                                <div class="row g-gs">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label" for="name">Nom du categorie</label>
                                            <div class="form-control-wrap">
                                                <input
                                                    type="text"
                                                    class="form-control @error('name') error @enderror"
                                                    id="name"
                                                    name="name"
                                                    value="{{ old('name') }}"
                                                    placeholder="Saisir le debut de l'annee"
                                                    required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label" for="academic">Annee academique</label>
                                            <div class="form-control-wrap">
                                                <select
                                                    class="form-control js-select2 @error('academic') error @enderror"
                                                    data-value="{{ old('academic') }}"
                                                    id="academic"
                                                    name="academic"
                                                    data-placeholder="Select a academic year"
                                                    required>
                                                    <option label="genre" value=""></option>
                                                    @foreach($academicYear as $year)
                                                        <option value="{{ $year->id }}">
                                                            {{  \Carbon\Carbon::createFromFormat('Y-m-d', $year->startDate)->format('Y') }}
                                                            -
                                                            {{ \Carbon\Carbon::createFromFormat('Y-m-d', $year->endDate)->format('Y') }}
                                                        </option>
                                                    @endforeach>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="form-label" for="description">Message</label>
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
                                            <button type="submit" class="btn btn-md btn-primary">Save Informations</button>
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
@endsection
