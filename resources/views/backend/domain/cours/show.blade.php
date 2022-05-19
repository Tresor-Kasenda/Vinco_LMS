@extends('backend.layout.base')

@section('title', "Gestion des cours")

@section('content')
    <div class="container-fluid">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="nk-block-head nk-block-head-sm">
                    <div class="nk-block-between">
                        <div class="nk-block-head-content">
                            <h3 class="nk-block-title page-title">Categorie ({{ strtoupper($course->name) }})</h3>
                        </div>
                        <div class="nk-block-head-content">
                            <div class="toggle-wrap nk-block-tools-toggle">
                                <div class="toggle-expand-content" data-content="more-options">
                                    <ul class="nk-block-tools g-3">
                                        <li>
                                            <div class="drodown">
                                                <div class="form-control-wrap">
                                                    <select name="status" id="status" class="form-select form-control form-control-lg">
                                                        <option value="default_option">Select Status</option>
                                                        <option value="{{ \App\Enums\StatusEnum::TRUE }}">Activated</option>
                                                        <option value="{{ \App\Enums\StatusEnum::FALSE }}">Deactivated</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="nk-block-tools-opt">
                                            <a class="btn btn-outline-light d-none d-md-inline-flex" href="{{ route('admins.categories.index') }}">
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
                    @if($course->status == \App\Enums\StatusEnum::FALSE)
                        <div class="alert alert-danger alert-icon " role="alert">
                            <em class="icon ni ni-bell"></em>
                            Le departement n'est pas encore confirmer
                        </div>
                    @endif
                    <div class="card">
                        <div class="card-aside-wrap">
                            <div class="card-inner card-inner-lg">
                                <div class="tab-content">
                                    <div class="tab-pane active">
                                        <div class="nk-block">
                                            <div class="profile-ud-list">
                                                <div class="profile-ud-item">
                                                    <div class="profile-ud wider">
                                                        <span class="profile-ud-label">Nom</span>
                                                        <span class="profile-ud-value">{{ $course->name ?? "" }}</span>
                                                    </div>
                                                </div>
                                                <div class="profile-ud-item">
                                                    <div class="profile-ud wider">
                                                        <span class="profile-ud-label">Annee academique</span>
                                                        <span class="profile-ud-value">
                                                            <span class="tb-lead">
                                                                {{  \Carbon\Carbon::createFromFormat('Y-m-d', $course->academic->startDate)->format('Y') }}
                                                                -
                                                                {{ \Carbon\Carbon::createFromFormat('Y-m-d', $course->academic->endDate)->format('Y') }}
                                                            </span>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="nk-divider divider md"></div>
                                        <div class="nk-block">
                                            <div class="bq-note">
                                                <div class="bq-note-item">
                                                    <div class="bq-note-text">
                                                        <p>
                                                            {{ $course->description ?? "" }}
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
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
                            console.log(response.message)
                        }
                    }
                })
            })
        })
    </script>
@endsection
