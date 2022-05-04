@extends('backend.layout.base')

@section('title', "Administration")

@section('content')
    <div class="container-fluid">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="nk-block-head nk-block-head-sm">
                    <div class="nk-block-between">
                        <div class="nk-block-head-content">
                            <h3 class="nk-block-title page-title">Personnels</h3>
                        </div>
                        <div class="nk-block-head-content">
                            <div class="toggle-wrap nk-block-tools-toggle">
                                <div class="toggle-expand-content" data-content="more-options">
                                    <ul class="nk-block-tools g-3">
                                        <li class="nk-block-tools-opt">
                                            <a class="btn btn-outline-light d-none d-md-inline-flex" href="{{ route('admins.personnel.index') }}">
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
                            <form action="{{ route('admins.personnel.store') }}" method="post" class="form-validate" novalidate="novalidate">
                                @csrf
                                <div class="row g-gs">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label" for="name">Votre nom</label>
                                            <div class="form-control-wrap">
                                                <input
                                                    type="text"
                                                    class="form-control @error('name') error @enderror"
                                                    id="name"
                                                    name="name"
                                                    value="{{ old('name') }}"
                                                    placeholder="Saisir votre nom"
                                                    required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label" for="firstName">Votre post-nom</label>
                                            <div class="form-control-wrap">
                                                <input
                                                    type="text"
                                                    class="form-control @error('firstName') error @enderror"
                                                    id="firstName"
                                                    name="firstName"
                                                    value="{{ old('firstName') }}"
                                                    placeholder="Saisir votre post-nom"
                                                    required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label" for="lastName">Votre prenom</label>
                                            <div class="form-control-wrap">
                                                <input
                                                    type="text"
                                                    class="form-control @error('lastName') error @enderror"
                                                    id="lastName"
                                                    name="lastName"
                                                    value="{{ old('lastName') }}"
                                                    placeholder="Saisir votre prenom"
                                                    required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label" for="email">Email address</label>
                                            <div class="form-control-wrap">
                                                <input
                                                    type="email"
                                                    class="form-control @error('email') error @enderror"
                                                    id="email"
                                                    name="email"
                                                    value="{{ old('email') }}"
                                                    placeholder="Saisir votre adresse email"
                                                    required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label" for="phone">Telephone</label>
                                            <div class="form-control-wrap">
                                                <div class="input-group">
                                                    <input
                                                        type="text"
                                                        class="form-control @error('phone') error @enderror"
                                                        name="phone"
                                                        id="phone"
                                                        value="{{ old('phone') }}"
                                                        placeholder="Saisir votre numero de telephone"
                                                        required>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label" for="nationality">Nationalite</label>
                                            <div class="form-control-wrap">
                                                <div class="input-group">
                                                    <input
                                                        type="text"
                                                        class="form-control @error('nationality') error @enderror"
                                                        name="nationality"
                                                        id="nationality"
                                                        value="{{ old('nationality') }}"
                                                        placeholder="Saisir votre nationalite"
                                                        required>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label" for="address">Adresse</label>
                                            <div class="form-control-wrap">
                                                <div class="input-group">
                                                    <input
                                                        type="text"
                                                        class="form-control @error('address') error @enderror"
                                                        name="address"
                                                        id="address"
                                                        value="{{ old('address') }}"
                                                        placeholder="Saisir votre adresse"
                                                        required>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label" for="identityCard">N Identite (carte ou passposrt)</label>
                                            <div class="form-control-wrap">
                                                <input
                                                    type="text"
                                                    class="form-control @error('identityCard') error @enderror"
                                                    id="identityCard"
                                                    name="identityCard"
                                                    value="{{ old('identityCard') }}"
                                                    placeholder="Saisir votre numero de carte d'identite"
                                                    required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label" for="images">Photo</label>
                                            <div class="form-control-wrap">
                                                <input
                                                    type="file"
                                                    class="form-control @error('images') error @enderror"
                                                    id="images"
                                                    name="images"
                                                    value="{{ old('images') }}"
                                                    placeholder="Saisir votre images"
                                                    required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label" for="role_id">Select Role</label>
                                            <div class="form-control-wrap">
                                                <select class="form-control js-select2 @error('role_id') error @enderror" id="role_id" name="role_id" data-placeholder="Select a role" required>
                                                    <option label="role" value=""></option>
                                                    @foreach($roles as $role)
                                                        <option value="{{ $role->id }}">{{ $role->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label" for="birthdays">Date de naissance</label>
                                            <div class="form-control-wrap">
                                                <input
                                                    type="text"
                                                    class="form-control date-picker @error('birthdays') error @enderror"
                                                    id="birthdays"
                                                    name="birthdays"
                                                    value="{{ old('birthdays') }}"
                                                    placeholder="Saisir votre date de naissance"
                                                    required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label" for="gender">Genre</label>
                                            <div class="form-control-wrap">
                                                <select class="form-control js-select2 @error('gender') error @enderror" data-value="{{ old('gender') }}" id="gender" name="gender" data-placeholder="Select a gender" required>
                                                    <option label="genre" value=""></option>
                                                    <option value="masculin">Masculin</option>
                                                    <option value="feminin">Feminin</option>
                                                </select>
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
