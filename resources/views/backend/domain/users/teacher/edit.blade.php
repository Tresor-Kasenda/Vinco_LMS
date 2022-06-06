@extends('backend.layout.base')

@section('title', "Edition du professeur")

@section('content')
    <div class="container-fluid">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="nk-block-head nk-block-head-sm">
                    <div class="nk-block-between">
                        <div class="nk-block-head-content">
                            <h3 class="nk-block-title page-title">Teacher ({{ strtoupper($professor->username) }})</h3>
                        </div>
                        <div class="nk-block-head-content">
                            <div class="toggle-wrap nk-block-tools-toggle">
                                <div class="toggle-expand-content" data-content="more-options">
                                    <ul class="nk-block-tools g-3">
                                        <li class="nk-block-tools-opt">
                                            <a class="btn btn-outline-light d-none d-md-inline-flex" href="{{ route('admins.users.teacher.index') }}">
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
                                    <form action="{{ route('admins.users.teacher.update', $professor->key) }}" method="post" class="form-validate" enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')
                                        <div class="row g-gs">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label class="form-label" for="name">Votre nom</label>
                                                    <div class="form-control-wrap">
                                                        <input
                                                            type="text"
                                                            class="form-control @error('name') error @enderror"
                                                            id="name"
                                                            name="name"
                                                            value="{{ old('name') ?? $professor->username }}"
                                                            placeholder="Saisir votre nom"
                                                            required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label class="form-label" for="firstName">Votre post-nom</label>
                                                    <div class="form-control-wrap">
                                                        <input
                                                            type="text"
                                                            class="form-control @error('firstName') error @enderror"
                                                            id="firstName"
                                                            name="firstName"
                                                            value="{{ old('firstName') ?? $professor->firstname }}"
                                                            placeholder="Saisir votre post-nom"
                                                            required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label class="form-label" for="lastName">Votre prenom</label>
                                                    <div class="form-control-wrap">
                                                        <input
                                                            type="text"
                                                            class="form-control @error('lastName') error @enderror"
                                                            id="lastName"
                                                            name="lastName"
                                                            value="{{ old('lastName') ?? $professor->lastname }}"
                                                            placeholder="Saisir votre prenom"
                                                            required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label class="form-label" for="email">Email address</label>
                                                    <div class="form-control-wrap">
                                                        <input
                                                            type="email"
                                                            class="form-control @error('email') error @enderror"
                                                            id="email"
                                                            name="email"
                                                            value="{{ old('email') ?? $professor->email }}"
                                                            pattern="\b[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}\b"
                                                            placeholder="Saisir votre adresse email"
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
                                                                value="{{ old('phones') ?? $professor->phones }}"
                                                                placeholder="Saisir votre numero de telephone"
                                                                required>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label class="form-label" for="nationality">Nationalite</label>
                                                    <div class="form-control-wrap">
                                                        <div class="input-group">
                                                            <input
                                                                type="text"
                                                                class="form-control @error('nationality') error @enderror"
                                                                name="nationality"
                                                                id="nationality"
                                                                value="{{ old('nationality') ?? $professor->country }}"
                                                                placeholder="Saisir votre nationalite"
                                                                required>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label class="form-label" for="address">Adresse</label>
                                                    <div class="form-control-wrap">
                                                        <div class="input-group">
                                                            <input
                                                                type="text"
                                                                class="form-control @error('address') error @enderror"
                                                                name="address"
                                                                id="address"
                                                                value="{{ old('address') ?? $professor->location }}"
                                                                placeholder="Saisir votre adresse"
                                                                required>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label class="form-label" for="identityCard">N Identite (carte ou passposrt)</label>
                                                    <div class="form-control-wrap">
                                                        <input
                                                            type="text"
                                                            class="form-control @error('identityCard') error @enderror"
                                                            id="identityCard"
                                                            name="identityCard"
                                                            value="{{ old('identityCard') ?? $professor->identityCard }}"
                                                            placeholder="Saisir votre numero de carte d'identite"
                                                            required>
                                                    </div>
                                                </div>
                                            </div>
                                            @php
                                                $users = \App\Models\User::query()
                                                    ->where('role_id', '=', \App\Enums\RoleEnum::PROFESSOR)
                                                    ->where('status', '=', \App\Enums\StatusEnum::TRUE)->get()
                                            @endphp
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label class="form-label" for="user">Select Professeur</label>
                                                    <div class="form-control-wrap">
                                                        <select
                                                            class="form-control js-select2 @error('user') error @enderror"
                                                            id="user"
                                                            name="user"
                                                            data-placeholder="Choisir le professeur"
                                                            required>
                                                            <option label="role" value="{{  $professor->user->name }}">{{  $professor->user->name }} {{  $professor->user->firstName }}</option>
                                                            @foreach($users as $user)
                                                                <option value="{{ $user->id }}">{{ $user->name }} {{ $user->firstName }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label class="form-label">Photo profile</label>
                                                    <div class="form-control-wrap">
                                                        <input
                                                            type="file"
                                                            class="form-control @error('images') error @enderror"
                                                            name="images"
                                                            value="{{ old('images') }}"
                                                            placeholder="Selectionnez une image"
                                                        >
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
                                                            value="{{ old('birthdays') ?? $professor->birthdays }}"
                                                            data-date-format="yyyy-mm-dd"
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
