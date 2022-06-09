@extends('backend.layout.base')

@section('title', "Detail sur le cours")

@section('content')
    <div class="container-fluid">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                @if($course->status == \App\Enums\StatusEnum::FALSE)
                    <div class="alert alert-fill alert-danger alert-icon">
                        <em class="icon ni ni-cross-circle"></em>
                        <strong>Course activation</strong>!
                        The course does not yet active.
                    </div>
                @endif
                <div class="nk-block-head nk-block-head-sm">
                    <div class="nk-block-between">
                        <div class="nk-block-head-content">
                            <h6 class="nk-block-title page-title">
                                Course Details
                            </h6>
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
                                                        @if($course->status == \App\Enums\StatusEnum::FALSE)
                                                            <option value="{{ \App\Enums\StatusEnum::TRUE }}">Activated</option>
                                                        @else
                                                            <option value="{{ \App\Enums\StatusEnum::FALSE }}">Deactivated</option>
                                                        @endif
                                                    </select>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="nk-block-tools-opt">
                                            <a class="btn btn-dim btn-primary btn-sm" href="{{ route('admins.academic.course.index') }}">
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
                            <div class="card">
                                <div class="card-body border-bottom py-3">
                                    <div class="text-center">
                                        <img
                                            @if($course->images)
                                                src="{{ asset('storage/'.$course->images) }}"
                                            @else
                                                src="{{ asset('assets/admins/images/default.png') }}"
                                            @endif
                                            title="{{ $course->name }}"
                                            class="img-fluid user-avatar-xl mb-3 text-center rounded-circle border-danger"
                                        >
                                    </div>
                                    <table class="table">
                                        <tbody>
                                        <tr>
                                            <th>Name</th>
                                            <td>{{ strtoupper($course->name) ?? "" }}</td>
                                        </tr>
                                        <tr>
                                            <th>Responsable</th>
                                            <td>{{ strtoupper($course->user->name) ?? "" }} {{ strtoupper($course->user->firstName) ?? "" }}</td>
                                        </tr>
                                        <tr>
                                            <th>Categorie</th>
                                            <td>{{ strtoupper($course->category->name) ?? "" }}</td>
                                        </tr>
                                        <tr>
                                            <th>Duration</th>
                                            <td>{{ strtoupper($course->duration) ?? "" }}</td>
                                        </tr>
                                        <tr>
                                            <th>Date de debut</th>
                                            <td>
                                                {{ \Carbon\Carbon::createFromFormat('Y-m-d', $course->startDate)->format('d F Y') }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Date de fin</th>
                                            <td>
                                                {{ \Carbon\Carbon::createFromFormat('Y-m-d', $course->endDate)->format('d F Y') }}
                                            </td>
                                        </tr>
                                        <tr class="text-justify">
                                            <th>Sous description</th>
                                            <td>{{ $course->subDescription ?? "" }}</td>
                                        </tr>
                                        <tr class="text-justify">
                                            <th>Description</th>
                                            <td>{{ $course->description ?? "" }}</td>
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
                    url: `{{ route('admins.course.active', $course->key) }}`,
                    data: {
                        status: status,
                        key: `{{ $course->key }}`,
                        _token: '{{ csrf_token() }}'
                    },
                    dataType : 'json',
                    success: function(response){
                        if (response){
                            Swal.fire(`${response.message}`, "update", "success");
                        }
                    }
                })
            })
        })
    </script>
@endsection
