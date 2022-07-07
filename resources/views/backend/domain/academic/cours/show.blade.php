@extends('backend.layout.base')

@section('title', "Detail sur le cours")

@section('content')
    <div class="container-fluid">
        <div class="nk-content-inner">
            <div class="nk-content-body">
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
                            @if($course->status == \App\Enums\StatusEnum::FALSE)
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
                                            <th>Nom du cours</th>
                                            <td>{{ ucfirst($course->name) ?? "" }}</td>
                                        </tr>
                                        <tr>
                                            <th>Professeurs</th>
                                            @if($course->professors)
                                                <td>
                                                    <ul class="link-list-opt">
                                                        @foreach($course->professors as $professor)
                                                            <li>
                                                                <a href="{{ route('admins.users.teacher.show', $professor->id) }}">
                                                                    <em class="icon ni ni-user"></em>
                                                                    <span>{{ ucfirst($professor->username) ?? "" }} {{ ucfirst($professor->lastname) ?? "" }}</span>
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <a href="{{ route('admins.users.teacher.show', $professor->id) }}">
                                                                    <em class="icon ni ni-emails"></em>
                                                                    <span>{{ $professor->email ?? "" }}</span>
                                                                </a>
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                </td>
                                            @endif
                                        </tr>
                                        <tr>
                                            <th>Nb des chapitres</th>
                                            <td>
                                                @if($course->chapters)
                                                    @foreach($course->chapters as $chapter)
                                                        <li>
                                                            <a href="{{ route('admins.academic.chapter.show', $chapter->id) }}">
                                                                <em class="icon ni ni-book-fill"></em>
                                                                <span>{{ ucfirst($chapter->name) ?? "" }}</span>
                                                            </a>
                                                        </li>
                                                    @endforeach
                                                @endif
                                            </td>
                                        </tr>

                                        <tr>
                                            <th>Categorie</th>
                                            <td>{{ ucfirst($course->category->name) ?? "" }}</td>
                                        </tr>
                                        <tr>
                                            <th>Ponderation</th>
                                            <td>{{ $course->ponderation() ?? "" }}</td>
                                        </tr>
                                        <tr class="text-justify">
                                            <th>Sous description</th>
                                            <td>{{ $course->sub_description ?? "" }}</td>
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
                    url: `{{ route('admins.course.active', $course->id) }}`,
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
