@extends('frontend.layout.register')

@section('title')
    Create an account
@endsection

@section('content')
    <div class="container-fluid">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="nk-block-head nk-block-head-sm">
                    <div class="nk-block-between">
                        <div class="nk-block-head-content">
                            <h3 class="nk-block-title page-title">Create an account</h3>
                        </div>
                        <div class="nk-block-head-content">
                            <div class="toggle-wrap nk-block-tools-toggle">
                                <div class="toggle-expand-content" data-content="more-options">
                                    <ul class="nk-block-tools g-3">
                                        <li class="nk-block-tools-opt">
                                            <a class="btn btn-dim btn-primary btn-sm"
                                               href="{{ route('home.index') }}">
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
                                    <form action="{{ route('home.student.store') }}" method="post" class="form-validate mt-2" enctype="multipart/form-data">
                                        @csrf
                                        <input type="hidden"
                                               id="institution_id"
                                               name="institution_id"
                                               value="{{ request('institution_id') }}"
                                        >
                                        <div class="row g-gs">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="form-label" for="name">Votre Prénom</label>
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
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="form-label" for="name">Votre Nom</label>
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
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="form-label" for="name">Votre PostNom</label>
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
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="form-label" for="startDate">Date de naissance</label>
                                                    <div class="form-control-wrap">
                                                        <input
                                                            type="text"
                                                            class="form-control date-picker @error('startDate') error @enderror"
                                                            id="startDate"
                                                            name="startDate"
                                                            value="{{ old('startDate') }}"
                                                            data-date-format="yyyy-mm-dd"
                                                            placeholder="Enter Birthday Date"
                                                            required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
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
                                                            placeholder="Enter Email"
                                                            required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="form-label" for="password">Mot de passe</label>
                                                    <div class="form-control-wrap">
                                                        <input
                                                            type="password"
                                                            class="form-control @error('password') error @enderror"
                                                            id="password"
                                                            name="password"
                                                            value="{{ old('password') }}"
                                                            placeholder="Enter password"
                                                            required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="form-label" for="name">Votre Pays</label>
                                                    <div class="form-control-wrap">
                                                        <input
                                                            type="text"
                                                            class="form-control @error('name') error @enderror"
                                                            id="name"
                                                            name="name"
                                                            value="{{ old('name') }}"
                                                            placeholder="Enter Country"
                                                            required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="form-label" for="name">Votre Ville</label>
                                                    <div class="form-control-wrap">
                                                        <input
                                                            type="text"
                                                            class="form-control @error('name') error @enderror"
                                                            id="name"
                                                            name="name"
                                                            value="{{ old('name') }}"
                                                            placeholder="Enter City"
                                                            required>
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
                                            <div class="col-md-12 text-center">
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

@section('scripts')
    <script>
        $(document).ready(function () {
            $('#department').on('change', function(e) {
                let cat_id = e.target.value;
                $.ajax({
                    url: "",
                    type: "get",
                    data: {
                        cat_id: cat_id
                    },
                    success: function(data) {
                        $('#subcategory').empty();
                    }
                })
            });
        });
    </script>
@endsection
