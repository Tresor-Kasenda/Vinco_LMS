@extends('backend.layout.base')

@section('title')
    Show Personnel
@endsection

@section('content')
    <div class="container-fluid">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="nk-block-head nk-block-head-sm">
                    <div class="nk-block-between">
                        <div class="nk-block-head-content">
                            <h3 class="nk-block-title page-title">
                                Show Personnel
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
                                                        @if($employee->status == \App\Enums\StatusEnum::FALSE)
                                                            <option value="{{ \App\Enums\StatusEnum::TRUE }}">Activated</option>
                                                        @else
                                                            <option value="{{ \App\Enums\StatusEnum::FALSE }}">Deactivated</option>
                                                        @endif
                                                    </select>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="nk-block-tools-opt">
                                            <a class="btn btn-outline-light d-none d-md-inline-flex" href="{{ route('admins.users.staffs.index') }}">
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
                    @if($employee->status == \App\Enums\StatusEnum::FALSE)
                        <div class="alert alert-danger alert-icon " role="alert">
                            <em class="icon ni ni-bell"></em>
                            Employer n'est pas encore confirmer
                        </div>
                    @endif
                    <div class="row justify-content-center">
                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-body border-bottom py-3">
                                        <div class="text-center">
                                            <img
                                                @if($employee->images)
                                                    src="{{ asset('storage/'.$employee->images) }}"
                                                @else
                                                    src="{{ asset('assets/admins/images/default.png') }}"
                                                @endif
                                                title="{{ $employee->username }}"
                                                class="img-fluid user-avatar-xl mb-3 text-center rounded-circle border-danger"
                                            >
                                        </div>
                                        <table class="table">
                                            <tbody>
                                            <tr>
                                                <th>Name</th>
                                                <td>{{ strtoupper($employee->username) ?? "" }}</td>
                                            </tr>
                                            <tr>
                                                <th>Last-Name</th>
                                                <td>{{ strtoupper($employee->lastname) ?? "" }}</td>
                                            </tr>
                                            <tr>
                                                <th>Email</th>
                                                <td>{{ $employee->email ?? "" }}</td>
                                            </tr>
                                            <tr>
                                                <th>Annee academique</th>
                                                <td>
                                                    {{ \Carbon\Carbon::createFromFormat('Y-m-d', $employee->academic->start_date)->format('Y') }}
                                                    -
                                                    {{ \Carbon\Carbon::createFromFormat('Y-m-d', $employee->academic->end_date)->format('Y') }}
                                                </td>
                                            </tr>
                                            <tr class="text-justify">
                                                <th>Phones</th>
                                                <td>{{ $employee->phones ?? "" }}</td>
                                            </tr>
                                            <tr class="text-justify">
                                                <th>Roles</th>
                                                <td>
                                                    <div class="tb-lead d-flex flex-wrap">
                                                        @foreach($employee->user->roles as $role)
                                                            <span class="badge bg-primary mx-1 mb-1">{{$role->name ?? "" }}</span>
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
                    url: `{{ route('admins.personnel.active', $employee->key) }}`,
                    data: {
                        status: status,
                        key: `{{ $employee->key }}`,
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
