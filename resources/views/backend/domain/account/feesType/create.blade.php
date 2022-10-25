@extends('backend.layout.base')

@section('title', "Creation de schedule")

@section('content')
    <div class="container-fluid">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="nk-block">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h6 class="card-title mt-2">Creation Fees Type</h6>
                            <a class="btn btn-outline-primary btn-sm  active-link mt-2" href="{{ route('admins.announce.feesTypes.index') }}">
                                <em class="icon ni ni-arrow-left"></em>
                                <span>Back</span>
                            </a>
                        </div>
                        <div class="card-body">
                            <div class="row justify-content-center">
                                <div class="col-md-6 mt-4">
                                    @if ($errors->any())
                                        <div class="alert alert-danger">
                                            <ul>
                                                @foreach ($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif
                                    <form action="{{ route('admins.announce.feesTypes.store') }}" method="post" class="form-validate" novalidate="novalidate" enctype="multipart/form-data">
                                        @csrf
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
                                                    <label class="form-label" for="name">Name</label>
                                                    <div class="form-control-wrap">
                                                        <input
                                                            type="text"
                                                            class="form-control @error('name') error @enderror"
                                                            id="name"
                                                            name="name"
                                                            value="{{ old('name') }}"
                                                            placeholder="Saisir le nom du cours"
                                                            required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12 mb-3">
                                                <div class="form-group">
                                                    <button type="submit" class="btn btn-md btn-outline-primary">Save</button>
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
