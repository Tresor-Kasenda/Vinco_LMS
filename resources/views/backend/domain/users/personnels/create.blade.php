@extends('backend.layout.base')

@section('title')
    Create Personnel
@endsection

@section('content')
    <div class="container-fluid">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="nk-block-head nk-block-head-sm">
                    <div class="nk-block-between">
                        <div class="nk-block-head-content">
                            <h3 class="nk-block-title page-title">Create Personnel</h3>
                        </div>
                        <div class="nk-block-head-content">
                            <div class="toggle-wrap nk-block-tools-toggle">
                                <div class="toggle-expand-content" data-content="more-options">
                                    <ul class="nk-block-tools g-3">
                                        <li class="nk-block-tools-opt">
                                            <a class="btn btn-dim btn-primary btn-sm" href="{{ $viewModel->indexUrl  }}">
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
                                    <form action="{{ route('admins.users.staffs.store') }}" method="post" class="form-validate mt-3" enctype="multipart/form-data">
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
                                                    <label class="form-label" for="email">Email</label>
                                                    <div class="form-control-wrap">
                                                        <input
                                                            type="email"
                                                            class="form-control @error('email') error @enderror"
                                                            id="email"
                                                            name="email"
                                                            value="{{ old('email') }}"
                                                            pattern="\b[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}\b"
                                                            placeholder="Enter email"
                                                            required>
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
                                                            @foreach($viewModel->roles() as $role)
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
                                                        <option label="Choisir l'annee academique" value=""></option>
                                                        @foreach($viewModel->academics() as $campus)
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
                                                            data-placeholder="Select a role"
                                                            required>
                                                            <option label="role" value=""></option>
                                                            @foreach($viewModel->institutions() as $institution)
                                                                <option value="{{ $institution->id }}">
                                                                    {{ ucfirst($institution->institution_name) }}
                                                                </option>
                                                            @endforeach
                                                        </select>
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
                                                                value="{{ old('phones') }}"
                                                                placeholder="Enter Phones Number"
                                                                required>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label class="form-label">Image</label>
                                                    <div class="form-control-wrap">
                                                        <input
                                                            type="file"
                                                            class="form-control @error('images') error @enderror"
                                                            name="images"
                                                            value="{{ old('images') }}"
                                                            placeholder="Enter Image"
                                                        >
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label class="form-label" for="password">Password</label>
                                                    <div class="form-control-wrap">
                                                        <input
                                                            type="password"
                                                            class="form-control @error('password') error @enderror"
                                                            name="password"
                                                            id="password"
                                                            value="{{ old('password') }}"
                                                            placeholder="Enter Password"
                                                        >
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
                                                                    checked
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
