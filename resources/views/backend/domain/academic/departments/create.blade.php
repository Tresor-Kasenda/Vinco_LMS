@extends('backend.layout.base')

@section('title')
    Create Department
@endsection

@section('content')
    <div class="container-fluid">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="nk-block-head nk-block-head-sm">
                    <div class="nk-block-between">
                        <div class="nk-block-head-content">
                            <h3 class="nk-block-title page-title">Create Department</h3>
                        </div>
                        <div class="nk-block-head-content">
                            <div class="toggle-wrap nk-block-tools-toggle">
                                <div class="toggle-expand-content" data-content="more-options">
                                    <ul class="nk-block-tools g-3">
                                        <li class="nk-block-tools-opt">
                                            <a class="btn btn-outline-light d-none d-md-inline-flex" href="{{ route('admins.academic.departments.index') }}">
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
                                    <form action="{{ route('admins.academic.departments.store') }}" method="post" class="form-validate" enctype="multipart/form-data">
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
                                                            placeholder="Enter Name"
                                                            required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label class="form-label" for="images">Image</label>
                                                    <div class="form-control-wrap">
                                                        <input
                                                            type="file"
                                                            class="form-control @error('images') error @enderror"
                                                            id="images"
                                                            name="images"
                                                            value="{{ old('images') }}"
                                                            placeholder="Choisir le logo du campus"
                                                            required>
                                                    </div>
                                                </div>
                                            </div>
                                            @php
                                                if (auth()->user()->hasRole('Super Admin')){
                                                    $users = \App\Models\User::query()
                                                        ->whereHas('roles', function ($query){
                                                            $query->whereNotIn('name', ['Super Admin', 'Admin', 'Etudiant', 'Parent', 'Comptable']);
                                                        })
                                                        ->with(['institution', 'teacher'])
                                                        ->get();
                                                    $campuses = \App\Models\Campus::query()
                                                        ->get();
                                                } else {
                                                    $users = \App\Models\User::query()
                                                        ->where('institution_id', '=', auth()->user()->institution->id)
                                                        ->with(['teacher', 'institution'])
                                                        ->whereHas('roles', function ($query){
                                                            $query->whereNotIn('name', ['Super Admin', 'Admin', 'Etudiant', 'Parent', 'Comptable']);
                                                        })
                                                        ->get();
                                                    $campuses = \App\Models\Campus::query()
                                                        ->where('institution_id', '=', auth()->user()->institution->id)->get();
                                                }
                                            @endphp

                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label class="form-label" for="user">Responsable</label>
                                                    <select
                                                        class="form-control js-select2  select2-hidden-accessible @error('user') error @enderror"
                                                        data-search="on"
                                                        id="user"
                                                        name="user"
                                                        data-placeholder="Select Responsable"
                                                        required>
                                                        <option label="Select Responsable" value=""></option>
                                                        @foreach($users as $user)
                                                            <option value="{{ $user->id }}">
                                                                {{ ucfirst($user->name) }}
                                                                @if(auth()->user()->hasRole('Super Admin'))
                                                                    (<small>{{ ucfirst($user->institution->institution_name) }}</small>)
                                                                @endif
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label class="form-label" for="campus">Campus</label>
                                                    <select
                                                        class="form-control js-select2 select2-hidden-accessible @error('campus') error @enderror"
                                                        data-search="on"
                                                        id="campus"
                                                        name="campus"
                                                        data-placeholder="Choisir la faculte"
                                                        required>
                                                        <option label="Choisir la faculte" value=""></option>
                                                        @foreach($campuses as $campus)
                                                            <option value="{{ $campus->id }}">
                                                                {{ $campus->name }} (<small>{{ ucfirst($campus->institution->institution_name) ?? "" }}</small>)
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label class="form-label" for="description">Description</label>
                                                    <div class="form-control-wrap">
                                                        <textarea
                                                            class="form-control form-control-sm"
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
