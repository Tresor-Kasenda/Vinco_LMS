@extends('backend.layout.base')

@section('title')
    Edit Campus
@endsection

@section('content')
    <div class="container-fluid">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="nk-block-head nk-block-head-sm">
                    <div class="nk-block-between">
                        <div class="nk-block-head-content">
                            <h3 class="nk-block-title page-title">Edit Create</h3>
                        </div>
                        <div class="nk-block-head-content">
                            <div class="toggle-wrap nk-block-tools-toggle">
                                <div class="toggle-expand-content" data-content="more-options">
                                    <ul class="nk-block-tools g-3">
                                        <li class="nk-block-tools-opt">
                                            <a class="btn btn-outline-light d-none d-md-inline-flex"
                                               href="{{ route('admins.academic.campus.index') }}">
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
                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                                <div class="col-md-6">
                                    <form action="{{ route('admins.academic.campus.update', $campus->id) }}" method="post" class="form-validate" enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')
                                        <div class="row g-gs">
                                            @if(auth()->user()->hasRole('Super Admin'))
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label class="form-label" for="institution">Institution</label>
                                                        <select
                                                            class="form-control js-select2 @error('institution') error @enderror"
                                                            id="institution"
                                                            name="institution"
                                                            data-placeholder="Select Institution"
                                                            required>
                                                            <option label="role" value=""></option>
                                                            @foreach(\App\Models\Institution::get() as $personnel)
                                                                <option
                                                                    value="{{ $personnel->id }}">
                                                                    {{ ucfirst($personnel->institution_name) ?? "" }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            @endif
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label class="form-label" for="name">Nom</label>
                                                    <div class="form-control-wrap">
                                                        <input
                                                            type="text"
                                                            class="form-control @error('name') error @enderror"
                                                            id="name"
                                                            name="name"
                                                            value="{{ old('name') ?? $campus->name }}"
                                                            placeholder="Enter Name"
                                                            required>
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
                                                            placeholder="Enter Image"
                                                            required>
                                                    </div>
                                                </div>
                                            </div>
                                            @php
                                                if(auth()->user()->hasRole('Super Admin')){
                                                    $personnels = \App\Models\User::query()
                                                        ->select(['id', 'name', 'institution_id'])
                                                        ->with('institution')
                                                        ->whereHas('roles', function ($query) {
                                                            $query->whereNotIn('name', ['Super Admin', 'Etudiant', 'Parent', 'Comptable']);
                                                        })
                                                        ->get();
                                                } else {
                                                    $personnels = \App\Models\User::query()
                                                        ->select(['id', 'name', 'institution_id'])
                                                        ->with(['institution' => function($query){
                                                            $query->where('id', '=', auth()->user()->institution_id);
                                                        }])
                                                        ->whereHas('roles', function ($query) {
                                                            $query->whereNotIn('name', ['Super Admin', 'Etudiant', 'Parent', 'Comptable']);
                                                        })
                                                        ->get();
                                                }

                                            @endphp

                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label class="form-label" for="personnel">Responsable</label>
                                                    <select
                                                        class="form-control js-select2 @error('personnel') error @enderror"
                                                        id="personnel"
                                                        name="personnel"
                                                        data-placeholder="Select a manager"
                                                        required>
                                                        <option value="{{ $campus->user->id }}">{{ ucfirst($campus->user->name) ?? "" }} (<small>{{ ucfirst($campus->user->institution->institution_name) ?? "" }}</option>
                                                        @foreach($personnels as $personnel)
                                                            <option value="{{ $personnel->id }}">
                                                                {{ ucfirst($personnel->name) ?? "" }} (<small>{{ ucfirst($personnel->institution->institution_name) ?? "" }}</small>)
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            @if(auth()->user()->hasRole('Super Admin'))
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label class="form-label" for="institution">Institution</label>
                                                        <select
                                                            class="form-control js-select2 @error('institution') error @enderror"
                                                            id="institution"
                                                            name="institution"
                                                            data-placeholder="Select Institution"
                                                            required>
                                                            <option value="{{ $campus->institution->id }}">{{ ucfirst($campus->institution->institution_name) ?? "" }}</option>
                                                            @foreach(\App\Models\Institution::get() as $personnel)
                                                                <option
                                                                    value="{{ $personnel->id }}">
                                                                    {{ ucfirst($personnel->institution_name) ?? "" }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            @endif
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label class="form-label" for="description">Description</label>
                                                    <div class="form-control-wrap">
                                                        <textarea
                                                            class="form-control form-control-sm"
                                                            id="description"
                                                            name="description"
                                                            placeholder="Write the description"
                                                        >{{ old('description') ?? $campus->description }}</textarea>
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
