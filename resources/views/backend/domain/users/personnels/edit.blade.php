@extends('backend.layout.base')

@section('title')
    Edit Personnel
@endsection

@section('content')
    <div class="container-fluid">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="nk-block-head nk-block-head-sm">
                    <div class="nk-block-between">
                        <div class="nk-block-head-content">
                            <h3 class="nk-block-title page-title">Edit Personnel</h3>
                        </div>
                        <div class="nk-block-head-content">
                            <div class="toggle-wrap nk-block-tools-toggle">
                                <div class="toggle-expand-content" data-content="more-options">
                                    <ul class="nk-block-tools g-3">
                                        <li class="nk-block-tools-opt">
                                            <a class="btn btn-dim btn-primary btn-sm" href="{{ route('admins.users.staffs.index') }}">
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
                                    <form action="{{ route('admins.users.staffs.update', $employee->id) }}" method="post" class="form-validate" enctype="multipart/form-data">
                                        @csrf
                                        {{ method_field('PUT') }}
                                        <div class="row g-gs">
                                            @php
                                                $roles = \App\Models\Role::query()
                                                        ->whereNotIn('name', ['Super Admin', 'Admin', 'Etudiant', 'Parent', 'Professeur', 'Comptable'])
                                                        ->get();
                                                $academic = \App\Models\AcademicYear::get();
                                                $institutions = \App\Models\Institution::select(['id', 'institution_name'])->get()
                                            @endphp
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label class="form-label" for="name">Nom</label>
                                                    <div class="form-control-wrap">
                                                        <input
                                                            type="text"
                                                            class="form-control @error('name') error @enderror"
                                                            id="name"
                                                            name="name"
                                                            value="{{ old('name') ?? $employee->username }}"
                                                            placeholder="Enter Name"
                                                            required>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label class="form-label" for="email">Email</label>
                                                    <div class="form-control-wrap">
                                                        <input
                                                            type="email"
                                                            class="form-control @error('email') error @enderror"
                                                            id="email"
                                                            name="email"
                                                            value="{{ old('email') ?? $employee->email }}"
                                                            pattern="\b[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}\b"
                                                            placeholder="Enter email"
                                                            required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label class="form-label" for="phones">Telephone</label>
                                                    <div class="form-control-wrap">
                                                        <div class="input-group">
                                                            <input
                                                                type="text"
                                                                class="form-control @error('phones') error @enderror"
                                                                name="phones"
                                                                id="phones"
                                                                value="{{ old('phones') ?? $employee->phones }}"
                                                                placeholder="Enter Phones Number"
                                                                required>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="form-label" for="role">Role</label>
                                                    <div class="form-control-wrap">
                                                        <select
                                                            class="form-control js-select2 select2-hidden-accessible @error('role') error @enderror"
                                                            data-value="{{ old('role') }}"
                                                            data-search="on"
                                                            id="role"
                                                            name="role"
                                                            data-placeholder="Select Role"
                                                            required>
                                                            <option label="Select Role" value=""></option>
                                                            @foreach($roles as $role)
                                                                <option value="{{ $role->id }}">
                                                                    {{ ucfirst($role->name) ?? "" }}
                                                                </option>
                                                            @endforeach>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="form-label" for="academic">Annee academique</label>
                                                    <select
                                                        class="form-control js-select2 select2-hidden-accessible @error('academic') error @enderror"
                                                        id="academic"
                                                        data-search="on"
                                                        name="academic"
                                                        data-placeholder="Choisir l'annee academique"
                                                        required>
                                                        <option value="{{ $employee->academic->id }}">
                                                            {{  \Carbon\Carbon::createFromFormat('Y-m-d', $employee->academic->start_date)->format('Y') }}
                                                            -
                                                            {{ \Carbon\Carbon::createFromFormat('Y-m-d', $employee->academic->end_date)->format('Y') }}
                                                        </option>
                                                        @foreach($academic as $campus)
                                                            <option value="{{ $campus->id }}">
                                                                {{  \Carbon\Carbon::createFromFormat('Y-m-d', $campus->start_date)->format('Y') }}
                                                                -
                                                                {{ \Carbon\Carbon::createFromFormat('Y-m-d', $campus->end_date)->format('Y') }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label class="form-label" for="institution">Instituttion</label>
                                                    <div class="form-control-wrap">
                                                        <select
                                                            class="form-control js-select2 select2-hidden-accessible @error('institution') error @enderror"
                                                            id="institution"
                                                            data-search="on"
                                                            name="institution"
                                                            data-placeholder="Select a institution"
                                                            required>
                                                            <option value="{{ $employee->user->institution->id }}">
                                                                {{ ucfirst($employee->user->institution->institution_name) ?? "" }}
                                                            </option>
                                                            @foreach($institutions as $institution)
                                                                <option value="{{ $institution->id }}">
                                                                    {{ ucfirst($institution->institution_name) }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-lg-12">
                                                <div class="form-group">
                                                    <label class="form-label" for="gender">Gender</label> <br>
                                                    <ul class="custom-control-group g-3 align-center flex-wrap">
                                                        <li>
                                                            <div class="custom-control custom-radio">
                                                                <input
                                                                    type="radio"
                                                                    class="custom-control-input"
                                                                    checked=""
                                                                    name="gender"
                                                                    value="male"
                                                                    id="male">
                                                                <label class="custom-control-label" for="male">Homme</label>
                                                            </div>
                                                        </li>
                                                        <li>
                                                            <div class="custom-control custom-radio checked">
                                                                <input
                                                                    type="radio"
                                                                    class="custom-control-input"
                                                                    name="gender"
                                                                    value="female"
                                                                    id="female">
                                                                <label class="custom-control-label" for="female">Femme</label>
                                                            </div>
                                                        </li>
                                                    </ul>
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
