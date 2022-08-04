@extends('backend.layout.base')

@section('title')
    Detail d'examen
@endsection

@section('content')
    <div class="container-fluid">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="nk-block-head nk-block-head-sm">
                    <div class="nk-block-between">
                        <div class="nk-block-head-content">
                            <h6 class="nk-block-title page-title">
                                Exam Details
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
                                                        @if($exam->status == \App\Enums\StatusEnum::FALSE)
                                                            <option value="{{ \App\Enums\StatusEnum::TRUE }}">Activated</option>
                                                        @else
                                                            <option value="{{ \App\Enums\StatusEnum::FALSE }}">Deactivated</option>
                                                        @endif
                                                    </select>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="nk-block-tools-opt">
                                            <a class="btn btn-dim btn-primary btn-sm" href="{{ route('admins.exam.exam.index') }}">
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
                            @if($exam->status == \App\Enums\StatusEnum::FALSE)
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
                                            @if($exam->course->images)
                                                src="{{ asset('storage/'.$exam->course->images) }}"
                                            @else
                                                src="{{ asset('assets/admins/images/default.png') }}"
                                            @endif
                                            title="{{ $exam->name }}"
                                            class="img-fluid user-avatar-xl mb-3 text-center rounded-circle border-danger"
                                        >
                                    </div>
                                    <table class="table">
                                        <tbody>
                                        <tr>
                                            <th>Nom du cours</th>
                                            <td>{{ ucfirst($exam->course->name) ?? "" }}</td>
                                        </tr>
                                        <tr class="text-justify">
                                            <th>Session D'examen</th>
                                            <td>{{ $exam->examSession->name ?? "" }}</td>
                                        </tr>
                                        <tr>
                                            <th>Ponderation</th>
                                            <td>{{ $exam->rating ?? "" }}</td>
                                        </tr>
                                        <tr class="text-justify">
                                            <th>Date</th>
                                            <td>{{ $exam->date ?? "" }}</td>
                                        </tr>
                                        <tr class="text-justify">
                                            <th>Heure de debut</th>
                                            <td>{{ $exam->start_time ?? "" }}</td>
                                        </tr>
                                        <tr class="text-justify">
                                            <th>Duree</th>
                                            <td>{{ $exam->duration ?? "" }}</td>
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
                    url: `{{ route('admins.exam.exam.active', $exam->id) }}`,
                    data: {
                        status: status,
                        key: `{{ $exam->id }}`,
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
