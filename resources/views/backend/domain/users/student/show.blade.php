@extends('backend.layout.base')

@section('title')
    Student Detail
@endsection

@section('content')
    <div class="container-fluid">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="nk-block-head nk-block-head-sm">
                    <div class="nk-block-between">
                        <div class="nk-block-head-content">
                            <h3 class="nk-block-title page-title">
                                Show Professor
                            </h3>
                        </div>
                        <div class="nk-block-head-content">
                            <div class="toggle-wrap nk-block-tools-toggle">
                                <div class="toggle-expand-content" data-content="more-options">
                                    <ul class="nk-block-tools g-3">
                                        <li>
                                            <div class="drodown">
                                                <div class="form-control-wrap">
                                                    <select name="status" id="status" class="form-select form-control form-control-sm">
                                                        <option value="default_option">Select Status</option>
                                                        @if($student->status == \App\Enums\StatusEnum::FALSE)
                                                            <option value="{{ \App\Enums\StatusEnum::TRUE }}">Activated</option>
                                                        @else
                                                            <option value="{{ \App\Enums\StatusEnum::FALSE }}">Deactivated</option>
                                                        @endif
                                                    </select>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="nk-block-tools-opt">
                                            <a class="btn btn-outline-light d-none d-md-inline-flex"
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
                    <div class="row justify-content-center">
                        <div class="col-md-6">
                            @if($student->status == \App\Enums\StatusEnum::FALSE)
                                <div class="alert alert-danger alert-icon">
                                    <em class="icon ni ni-cross-circle"></em>
                                    <strong>Course activation</strong>!
                                    The course does not yet active.
                                </div>
                            @endif
                            <div class="card">
                                <div class="card-body border-bottom py-3">
                                    <div class="text-center">
                                        <img
                                            @if($student->images)
                                                src="{{ $student->getImages() }}"
                                            @else
                                                src="{{ asset('assets/admins/images/man.webp') }}"
                                            @endif
                                            title="{{ $student->name }}"
                                            class="img-fluid user-avatar-xl mb-3 text-center rounded-circle border-danger"
                                        >
                                    </div>
                                    <table class="table">
                                        <tbody>
                                        <tr>
                                            <th>Name</th>
                                            <td>{{ ucfirst($student->name) ?? "" }}</td>
                                        </tr>
                                        <tr>
                                            <th>Firstname</th>
                                            <td>{{ ucfirst($student->fristname) ?? "" }}</td>
                                        </tr>
                                        <tr>
                                            <th>Last-Name</th>
                                            <td>{{ ucfirst($student->lastname) ?? "" }}</td>
                                        </tr>
                                        <tr>
                                            <th>Matricule</th>
                                            <td>{{ $student->matriculate ?? "" }}</td>
                                        </tr>
                                        <tr>
                                            <th>Email</th>
                                            <td>{{ $student->email ?? "" }}</td>
                                        </tr>

                                        <tr>
                                            <th>Departement</th>
                                            <td>
                                                <a href="{{ route('admins.academic.departments.show', $student->department->id) }}">
                                                    {{ ucfirst($student->department->name) ?? "" }}
                                                </a>
                                            </td>
                                        </tr>

                                        <tr>
                                            <th>Promotion</th>
                                            <td>
                                                <a href="{{ route('admins.academic.promotion.show', $student->promotion->id) }}">
                                                    {{ ucfirst($student->promotion->name) ?? "" }}
                                                </a>
                                            </td>
                                        </tr>

                                        <tr class="text-justify">
                                            <th>Phones</th>
                                            <td>{{ $student->phone_number ?? "" }}</td>
                                        </tr>
                                        <tr>
                                            <th>Genre</th>
                                            <td>
                                                @if($student->gender == 'male')
                                                    MASCULIN
                                                @else
                                                    FEMININ
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Address</th>
                                            <td>
                                                {{ $teacher->location ?? "" }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Nationalite</th>
                                            <td>
                                                {{ $student->nationality ?? "" }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Parent</th>
                                            <td>
                                                <a href="{{ route('admins.users.guardian.show', $student->parent->id) }}">
                                                    {{ ucfirst($student->parent->name_guardian) ?? "" }}
                                                </a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Date D'inscription</th>
                                            <td>{{ $student->adminssion_date ?? "" }}</td>
                                        </tr>
                                        <tr class="text-justify">
                                            <th>Roles</th>
                                            <td>
                                                <div class="tb-lead d-flex flex-wrap">
                                                    @foreach($student->user->roles as $role)
                                                        <span
                                                            class="badge bg-primary mx-1 mb-1">{{$role->name ?? "" }}</span>
                                                    @endforeach
                                                </div>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
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
            $('#status').on('change', function(){
                const status = $("#status option:selected").val()
                $.ajax({
                    type: "put",
                    url: `{{ route('admins.administrator.active', $student->id) }}`,
                    data: {
                        status: status,
                        key: `{{ $student->id }}`,
                        _token: '{{ csrf_token() }}'
                    },
                    dataType : 'json',
                    success: function(response){
                        if (response){
                            Swal.fire(`${response.message}`, "update", "success");
                            console.log(response.message)
                        }
                    }
                })
            })
        })
    </script>
@endsection
