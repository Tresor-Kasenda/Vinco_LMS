@extends('backend.layout.base')

@section('title')
    Edit Promotion
@endsection

@section('content')
    <div class="container-fluid">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="nk-block-head nk-block-head-sm">
                    <div class="nk-block-between">
                        <div class="nk-block-head-content">
                            <h3 class="nk-block-title page-title">Edit Promotion</h3>
                        </div>
                        <div class="nk-block-head-content">
                            <div class="toggle-wrap nk-block-tools-toggle">
                                <div class="toggle-expand-content" data-content="more-options">
                                    <ul class="nk-block-tools g-3">
                                        <li class="nk-block-tools-opt">
                                            <a class="btn btn-dim btn-primary btn-sm" href="{{ route('admins.academic.promotion.index') }}">
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
                                    <form action="{{ route('admins.academic.promotion.update', $promotion->id) }}" method="post" class="form-validate" enctype="multipart/form-data">
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
                                                            value="{{ old('name') ?? $promotion->name }}"
                                                            placeholder="Enter Name"
                                                            required>
                                                    </div>
                                                </div>
                                            </div>

                                            @php
                                                if (auth()->user()->hasRole('Super Admin')){
                                                    $filiaires = \App\Models\Subsidiary::query()
                                                        ->select([
                                                            'id',
                                                            'name',
                                                            'department_id'
                                                        ])
                                                        ->with([
                                                            'department:id,name,campus_id' => [
                                                                'campus:id,institution_id' => [
                                                                    'institution:id,institution_name'
                                                                ]
                                                            ]
                                                        ])
                                                        ->get();
                                                    $academics = \App\Models\AcademicYear::query()
                                                         ->whereHas('institution', function ($builder){
                                                             $builder->orderBy('institution_name');
                                                         })
                                                         ->get();
                                                } else {
                                                    $filiaires = \App\Models\Subsidiary::query()
                                                        ->select([
                                                            'id',
                                                            'name',
                                                            'department_id'
                                                        ])
                                                        ->whereHas('department', function ($builder){
                                                            $builder->whereHas('campus', function ($builder){
                                                                $builder->where('institution_id', auth()->user()->institution->id);
                                                            });
                                                        })
                                                        ->with([
                                                            'department:id,name,campus_id' => [
                                                                'campus:id,institution_id' => [
                                                                    'institution:id,institution_name'
                                                                ]
                                                            ]
                                                        ])
                                                        ->get();
                                                    $academics = \App\Models\AcademicYear::query()
                                                        ->where(
                                                            'institution_id', '=', auth()->user()->institution->id
                                                        )
                                                         ->whereHas('institution', function ($builder){
                                                             $builder->orderBy('institution_name');
                                                         })
                                                         ->get();
                                                }
                                            @endphp

                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label class="form-label" for="academic">Annee academique</label>
                                                    <select
                                                        class="form-control js-select2 select2-hidden-accessible @error('academic') error @enderror"
                                                        id="academic"
                                                        name="academic"
                                                        data-search="on"
                                                        data-placeholder="Choisir l'annee academique"
                                                        required>
                                                        <option value="{{ $promotion->academic->id }}">
                                                            {{
                                                                \Carbon\Carbon::createFromFormat('Y-m-d', $promotion->academic->start_date)->format('Y')
                                                                ?? ""
                                                            }}-
                                                            {{
                                                                \Carbon\Carbon::createFromFormat('Y-m-d', $promotion->academic->end_date)->format('Y')
                                                                ?? ""
                                                            }}
                                                        </option>
                                                        @foreach($academics as $academic)
                                                            <option value="{{ $academic->id }}">
                                                                {{  \Carbon\Carbon::createFromFormat('Y-m-d', $academic->start_date)->format('Y') }}
                                                                -
                                                                {{ \Carbon\Carbon::createFromFormat('Y-m-d', $academic->end_date)->format('Y') }}
                                                                @if(auth()->user()->hasRole('Super Admin'))
                                                                    (<small>{{ ucfirst($academic->institution->institution_name) ?? "" }}</small>)
                                                                @endif
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label class="form-label" for="filiaire">FIliaire</label>
                                                    <select
                                                        class="form-control js-select2 select2-hidden-accessible @error('filiaire') error @enderror"
                                                        id="filiaire"
                                                        data-search="on"
                                                        name="filiaire"
                                                        data-placeholder="Choisir le filiaire"
                                                        required>
                                                        <option value="{{ $promotion->subsidiary->id }}">{{ $promotion->subsidiary->name }}</option>
                                                        @foreach($filiaires as $filiaire)
                                                            <option value="{{ $filiaire->id }}">
                                                                {{ ucfirst($filiaire->name) ?? "" }} /(<small>{{ ucfirst($filiaire->department->name) ?? "" }}</small>)
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label class="form-label" for="description">Message</label>
                                                    <div class="form-control-wrap">
                                                        <textarea
                                                            class="form-control form-control-sm"
                                                            id="description"
                                                            name="description"
                                                            placeholder="Enter the description"
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
