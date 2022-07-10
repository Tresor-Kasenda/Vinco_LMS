@extends('backend.layout.base')

@section('title')
    Edit Institution
@endsection

@section('content')
    <div>
        <div class="container-fluid">
            <div class="nk-content-inner">
                <div class="nk-content-body">
                    <div class="nk-block-head nk-block-head-sm">
                        <div class="nk-block-between">
                            <div class="nk-block-head-content">
                                <h3 class="nk-block-title page-title">Edit Student</h3>
                            </div>
                            <div class="nk-block-head-content">
                                <div class="toggle-wrap nk-block-tools-toggle">
                                    <div class="toggle-expand-content" data-content="more-options">
                                        <ul class="nk-block-tools g-3">
                                            <li class="nk-block-tools-opt">
                                                <a class="btn btn-dim btn-primary btn-sm"
                                                   href="{{ route('admins.institution.index') }}">
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
                                    <div class="col-md-7">
                                        @if ($errors->any())
                                            <div class="alert alert-danger">
                                                <ul>
                                                    @foreach ($errors->all() as $error)
                                                        <li>{{ $error }}</li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        @endif
                                        <form method="post" action="{{ route('admins.institution.update', $institution->id) }}" class="form-validate mt-2" enctype="multipart/form-data">
                                            @csrf
                                            @method('PUT')
                                            <div class="row g-gs">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label class="form-label" for="name">Nom Institution</label>
                                                        <div class="form-control-wrap">
                                                            <input
                                                                type="text"
                                                                class="form-control @error('institution_name') error @enderror"
                                                                id="name"
                                                                name="institution_name"
                                                                value="{{ old('institution_name') ?? $institution->institution_name }}"
                                                                placeholder="Enter Institution Name"
                                                                required>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label class="form-label" for="">Country</label>
                                                        <div class="form-control-wrap">
                                                            <input
                                                                type="text"
                                                                class="form-control @error('institution_country') error @enderror"
                                                                id="country"
                                                                name="institution_country"
                                                                value="{{ old('institution_country') ?? $institution->institution_country }}"
                                                                placeholder="Enter Country"
                                                                required>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label class="form-label" for="town">Ville</label>
                                                        <div class="form-control-wrap">
                                                            <input
                                                                type="text"
                                                                class="form-control @error('institution_town') error @enderror"
                                                                id="town"
                                                                name="institution_town"
                                                                value="{{ old('institution_town') ?? $institution->institution_town }}"
                                                                placeholder="Enter Town of Institution"
                                                                required>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label class="form-label" for="user">Dirigeant / Gestionnaire</label>
                                                        <div class="form-control-wrap">
                                                            <select
                                                                class="form-control js-select2 @error('manager') error @enderror"
                                                                id="user"
                                                                name="manager"
                                                                data-placeholder="Select Manager of School"
                                                                required>
                                                                <option label="class" value=""></option>
                                                                @foreach(\App\Models\Personnel::all() as $manager)
                                                                    <option
                                                                        value="{!! $manager->user_id !!}"
                                                                    >{{ ucfirst($manager->username ) ?? "" }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="form-label" for="phones">Telephone</label>
                                                        <div class="form-control-wrap">
                                                            <input
                                                                type="text"
                                                                class="form-control @error('institution_phones') error @enderror"
                                                                id="institution_phones"
                                                                name="institution_phones"
                                                                value="{{ old('institution_phones') ?? $institution->institution_phones }}"
                                                                placeholder="Enter phones Number"
                                                                required>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="form-label" for="website">Website</label>
                                                        <div class="form-control-wrap">
                                                            <input
                                                                type="text"
                                                                class="form-control @error('institution_website') error @enderror"
                                                                id="website"
                                                                name="institution_website"
                                                                value="{{ old('institution_website') ?? $institution->institution_website }}"
                                                                placeholder="Enter Website"
                                                                required>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label class="form-label" for="address">Address</label>
                                                        <div class="form-control-wrap">
                                                            <input
                                                                type="text"
                                                                class="form-control @error('institution_address') error @enderror"
                                                                id="address"
                                                                name="institution_address"
                                                                value="{{ old('institution_address')  ?? $institution->institution_address }}"
                                                                placeholder="Enter Address"
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
                                                                placeholder="Select image"
                                                                required>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-12 text-center">
                                                    <div class="form-group">
                                                        <button type="submit" class="btn btn-md btn-primary">
                                                            Save
                                                        </button>
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
    </div>

@endsection
