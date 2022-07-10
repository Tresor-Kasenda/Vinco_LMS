@extends('backend.layout.base')

@section('title')
    Homework Detail
@endsection

@section('content')
    <div class="container-fluid">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="nk-block-head nk-block-head-sm">
                    <div class="nk-block-between">
                        <div class="nk-block-head-content">
                            <h3 class="nk-block-title page-title">Devoir du devoir</h3>
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
                                                        @if($homework->status == \App\Enums\StatusEnum::FALSE)
                                                            <option value="{{ \App\Enums\StatusEnum::TRUE }}">Activated</option>
                                                        @else
                                                            <option value="{{ \App\Enums\StatusEnum::FALSE }}">Deactivated</option>
                                                        @endif
                                                    </select>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="nk-block-tools-opt">
                                            <a class="btn btn-dim btn-primary btn-sm" href="{{ route('admins.academic.homework.index') }}">
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
                            @if($homework->status == \App\Enums\StatusEnum::FALSE)
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
                                            @if($homework->course->images)
                                                src="{{ asset('storage/'.$homework->course->images) }}"
                                            @else
                                                src="{{ asset('assets/admins/images/default.png') }}"
                                            @endif
                                            title="{{ $homework->name }}"
                                            class="img-fluid user-avatar-xl mb-3 text-center rounded-circle border-danger"
                                        >
                                    </div>
                                    <table class="table">
                                        <tbody>
                                        <tr>
                                            <th>Nom du cours</th>
                                            <td>{{ ucfirst($homework->course->name) ?? "" }}</td>
                                        </tr>
                                        <tr>
                                            <th>chapitres</th>
                                            <td>
                                                {{ ucfirst($homework->chapter->name) }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Lecon</th>
                                            <td>
                                                {{ ucfirst($homework->lesson->name) }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Titre du devoir (TP)</th>
                                            <td>{{ $homework->name ?? "" }}</td>
                                        </tr>
                                        <tr>
                                            <th>Ponderation</th>
                                            <td>{{ $homework->rating_homework ?? "" }}</td>
                                        </tr>
                                        <tr>
                                            <th>Date depot</th>
                                            <td>{{ $homework->filling_date ?? "" }}</td>
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
                    url: `{{ route('admins.course.active', $homework->id) }}`,
                    data: {
                        status: status,
                        key: `{{ $homework->key }}`,
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

