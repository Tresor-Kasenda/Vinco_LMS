@extends('backend.layout.base')

@section('title')
    Detail sur le campus
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
                                                    <select name="status" id="status"
                                                            class="form-select form-control form-control-sm">
                                                        <option value="default_option">Select Status</option>
                                                        @if($campus->status == \App\Enums\StatusEnum::FALSE)
                                                            <option value="{{ \App\Enums\StatusEnum::TRUE }}">
                                                                Activated
                                                            </option>
                                                        @else
                                                            <option value="{{ \App\Enums\StatusEnum::FALSE }}">
                                                                Deactivated
                                                            </option>
                                                        @endif
                                                    </select>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="nk-block-tools-opt">
                                            <a class="btn btn-outline-light d-none d-md-inline-flex"
                                               href="{{ route('admins.academic.campus.index') }}">
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
                            @if($campus->status == \App\Enums\StatusEnum::FALSE)
                                <div class="alert alert-danger alert-icon " role="alert">
                                    <em class="icon ni ni-bell"></em>
                                    Le campus n'est pas encore confirmer
                                </div>
                            @endif
                            <div class="card">
                                <div class="card-body border-bottom py-3">
                                    <div class="text-center">
                                        <img
                                            @if($campus->images)
                                                src="{{ asset('storage/'.$campus->images) }}"
                                            @else
                                                src="{{ asset('assets/admins/images/man.webp') }}"
                                            @endif
                                            title="{{ $campus->username }}"
                                            class="img-fluid user-avatar-xl mb-3 text-center rounded-circle border-danger"
                                        >
                                    </div>
                                    <table class="table">
                                        <tbody>
                                        <tr>
                                            <th>Nom du Campus</th>
                                            <td>{{ ucfirst($campus->name) ?? "" }}</td>
                                        </tr>
                                        <tr>
                                            <th>Institution</th>
                                            <td class="font-weight-bold">{{ ucfirst($campus->institution->institution_name) ?? "" }}</td>
                                        </tr>
                                        <tr>
                                            <th>Responsable du campus</th>
                                            <td>{{ ucfirst($campus->user->name) ?? "" }}</td>
                                        </tr>
                                        <tr>
                                            <th>Email Responsable</th>
                                            <td>{{ $campus->user->email ?? "" }}</td>
                                        </tr>
                                        <tr>
                                            <th>Liste des Departements</th>
                                            <td>
                                                <div class="tb-lead d-flex flex-wrap">
                                                    @if($campus->departments)
                                                        @foreach($campus->departments as $department)
                                                            <span class="badge bg-primary mx-1 mb-1">
                                                                {{ ucfirst($department->name) }}
                                                            </span>
                                                        @endforeach
                                                    @endif
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Description</th>
                                            <td>{{ $campus->description ?? "-" }}</td>
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
            $('#status').on('change', function () {
                const status = $("#status option:selected").val()
                $.ajax({
                    type: "put",
                    url: `{{ route('admins.campus.active', $campus->id) }}`,
                    data: {
                        status: status,
                        key: `{{ $campus->key }}`,
                        _token: '{{ csrf_token() }}'
                    },
                    dataType: 'json',
                    success: function (response) {
                        if (response) {
                            Swal.fire(`${response.message}`, "update", "success");
                            console.log(response.message)
                        }
                    }
                })
            })
        })
    </script>
@endsection
