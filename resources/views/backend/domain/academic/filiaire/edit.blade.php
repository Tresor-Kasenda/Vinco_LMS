@extends('backend.layout.base')

@section('title')
    Edit Filiaire
@endsection

@section('content')
    <div class="container-fluid">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="nk-block-head nk-block-head-sm">
                    <div class="nk-block-between">
                        <div class="nk-block-head-content">
                            <h3 class="nk-block-title page-title">Edit filiaire</h3>
                        </div>
                        <div class="nk-block-head-content">
                            <div class="toggle-wrap nk-block-tools-toggle">
                                <div class="toggle-expand-content" data-content="more-options">
                                    <ul class="nk-block-tools g-3">
                                        <li class="nk-block-tools-opt">
                                            <a class="btn btn-dim btn-primary btn-sm" href="{{ route('admins.academic.filiaire.index') }}">
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
                                    <form action="{{ route('admins.academic.filiaire.update', $filiaire->id) }}" method="post" class="form-validate">
                                        @csrf
                                        @method('PUT')
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
                                                            value="{{ old('name') ?? $filiaire->name }}"
                                                            placeholder="Enter name"
                                                            required>
                                                    </div>
                                                </div>
                                            </div>
                                            @php
                                                if (auth()->user()->hasRole('Super Admin')) {
                                                    $professors = \App\Models\User::query()
                                                        ->select(['id', 'name', 'institution_id', 'email'])
                                                        ->whereHas('roles', function ($query) {
                                                            $query->whereNotIn('name', ['Super Admin', 'Etudiant', 'Parent', 'Comptable']);
                                                        })
                                                        ->with('institution:id,institution_name')
                                                        ->get();
                                                    $departments = \App\Models\Department::query()
                                                        ->with([
                                                            'campus:id,name,institution_id',
                                                            'campus' => [
                                                                'institution:id,institution_name'
                                                            ]
                                                        ])
                                                        ->get();
                                                } else {
                                                    $professors = \App\Models\User::query()
                                                        ->select(['id', 'name', 'institution_id', 'email'])
                                                        ->whereHas('roles', function ($query) {
                                                            $query->whereNotIn('name', ['Super Admin', 'Etudiant', 'Parent', 'Comptable']);
                                                        })
                                                        ->where('institution_id', '=', auth()->user()->institution->id)
                                                        ->get();
                                                    $departments = \App\Models\Department::query()
                                                        ->whereHas('campus', function ($builder){
                                                            $builder->where('institution_id', auth()->user()->institution->id);
                                                        })
                                                        ->with([
                                                            'campus:id,name,institution_id',
                                                            'campus' => [
                                                                'institution:id,institution_name'
                                                            ]
                                                        ])
                                                        ->get();
                                                }
                                            @endphp

                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label class="form-label" for="user">Responsable</label>
                                                    <select
                                                        class="form-control js-select2 select2-hidden-accessible @error('user') error @enderror"
                                                        id="user"
                                                        name="user"
                                                        data-search="on"
                                                        data-placeholder="Select Responsable"
                                                        required>
                                                        <option value="{{ $filiaire->user->id }}">
                                                            {{ ucfirst($filiaire->user->name) ?? "" }}
                                                        </option>
                                                        @foreach($professors as $professor)
                                                            <option value="{{ $professor->id }}">
                                                                {{ ucfirst($professor->name) }}
                                                                @if(auth()->user()->hasRole('Super Admin'))
                                                                    (<small>{{ ucfirst($professor->institution->institution_name) ?? "" }}</small>)
                                                                @endif
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label class="form-label" for="department">Departement</label>
                                                    <select
                                                        class="form-control js-select2 select2-hidden-accessible @error('department') error @enderror"
                                                        id="department"
                                                        data-search="on"
                                                        name="department"
                                                        data-placeholder="Select le departement"
                                                        required>
                                                        <option value="{{ $filiaire->department->id }}">
                                                            {{ ucfirst($filiaire->department->name) ?? "" }}
                                                        </option>
                                                        @foreach($departments as $department)
                                                            <option value="{{ $department->id }}">
                                                                {{ ucfirst($department->name) }}
                                                                (<small>
                                                                    {{ ucfirst($department->campus->name) ?? "" }}/
                                                                    {{ ucfirst($department->campus->institution->institution_name) ?? "" }}
                                                                </small>)
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
                                                        >{{ old('description') ?? $filiaire->description }}</textarea>
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
