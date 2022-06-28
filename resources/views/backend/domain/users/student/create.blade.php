@extends('backend.layout.base')

@section('title')
    Create Student
@endsection

@section('content')
    <div class="container-fluid">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="nk-block-head nk-block-head-sm">
                    <div class="nk-block-between">
                        <div class="nk-block-head-content">
                            <h3 class="nk-block-title page-title">Create Student</h3>
                        </div>
                        <div class="nk-block-head-content">
                            <div class="toggle-wrap nk-block-tools-toggle">
                                <div class="toggle-expand-content" data-content="more-options">
                                    <ul class="nk-block-tools g-3">
                                        <li class="nk-block-tools-opt">
                                            <a class="btn btn-dim btn-primary btn-sm"
                                               href="{{ route('admins.users.student.index') }}">
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
                                    <form action="{{ route('admins.users.student.store') }}" method="post" class="form-validate mt-2" enctype="multipart/form-data">
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
                                                            placeholder="Enter Name"
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
                                                    <label class="form-label" for="parent">Parent</label>
                                                    <div class="form-control-wrap">
                                                        <select
                                                            class="form-control js-select2 @error('parent') error @enderror"
                                                            id="parent"
                                                            name="parent"
                                                            data-placeholder="Select Parent"
                                                            required>
                                                            <option label="parent" value=""></option>
                                                            @foreach(\App\Models\Guardian::all() as $class)
                                                                <option
                                                                    value="{{ $class->id }}"
                                                                >{{ ucfirst($class->name_guardian ) ?? "" }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="form-label" for="department">Departement</label>
                                                    <div class="form-control-wrap">
                                                        <select
                                                            class="form-control js-select2 @error('department') error @enderror"
                                                            id="department"
                                                            name="department"
                                                            data-placeholder="Select Department"
                                                            required>
                                                            <option label="department" value=""></option>
                                                            @foreach(\App\Models\Department::all() as $class)
                                                                <option
                                                                    value="{{ $class->id }}"
                                                                >{{ ucfirst($class->name ) ?? "" }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="form-label" for="filiaire">Filiaire</label>
                                                    <div class="form-control-wrap">
                                                        <select
                                                            class="form-control js-select2 @error('filiaire') error @enderror"
                                                            id="filiaire"
                                                            name="filiaire"
                                                            data-placeholder="Select Filiaire"
                                                            required>
                                                            <option label="filiaire" value=""></option>
                                                            @foreach(\App\Models\Subsidiary::all() as $class)
                                                                <option
                                                                    value="{{ $class->id }}"
                                                                >{{ ucfirst($class->name ) ?? "" }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="form-label" for="class">Promotion</label>
                                                    <div class="form-control-wrap">
                                                        <select
                                                            class="form-control js-select2 @error('class') error @enderror"
                                                            id="class"
                                                            name="class"
                                                            data-placeholder="Select Promotion"
                                                            required>
                                                            <option label="class" value=""></option>
                                                            @foreach(\App\Models\Promotion::all() as $class)
                                                                <option
                                                                    value="{{ $class->id }}"
                                                                >{{ ucfirst($class->name ) ?? "" }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="form-label" for="admission">Admission Date</label>
                                                    <div class="form-control-wrap">
                                                        <input
                                                            type="text"
                                                            class="form-control date-picker @error('admission') error @enderror"
                                                            id="admission"
                                                            name="admission"
                                                            data-date-format="yyyy-mm-dd"
                                                            value="{{ old('admission') }}"
                                                            placeholder="Select Admission Date"
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
