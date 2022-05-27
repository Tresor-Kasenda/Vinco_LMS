@extends('backend.layout.base')

@section('title', "Administration")

@section('content')
    <div class="container-fluid">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="nk-block-head nk-block-head-sm">
                    <div class="nk-block-between">
                        <div class="nk-block-head-content">
                            <h3 class="nk-block-title page-title">Campus ({{ strtoupper($campus->name) }})</h3>
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
                                                        @if($campus->status == \App\Enums\StatusEnum::FALSE)
                                                            <option value="{{ \App\Enums\StatusEnum::TRUE }}">Activated</option>
                                                        @else
                                                            <option value="{{ \App\Enums\StatusEnum::FALSE }}">Deactivated</option>
                                                        @endif
                                                    </select>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="nk-block-tools-opt">
                                            <a class="btn btn-outline-light d-none d-md-inline-flex" href="{{ route('admins.campus.index') }}">
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
                    @if($campus->status == \App\Enums\StatusEnum::FALSE)
                        <div class="alert alert-danger alert-icon " role="alert">
                            <em class="icon ni ni-bell"></em>
                            Le campus n'est pas encore confirmer
                        </div>
                    @endif
                        <div class="justify-content text-center p-2">
                            <img
                                @if($campus->images)
                                    src="{{ asset('storage/'.$campus->images) }}"
                                @else

                                @endif
                                alt="{{ $campus->name }}"
                                class="img-fluid img-thumbnail rounded-circle"
                                height="15%"
                                width="10%"
                            >
                        </div>
                    <div class="card">
                        <div class="card-aside-wrap">
                            <div class="card-inner card-inner-lg">
                                <div class="tab-content">
                                    <div class="tab-pane active">
                                        <div class="nk-block">
                                            <div class="profile-ud-list">
                                                <div class="profile-ud-item">
                                                    <div class="profile-ud wider">
                                                        <span class="profile-ud-label">Nom du campus</span>
                                                        <span class="profile-ud-value">{{ $campus->name ?? "" }}</span>
                                                    </div>
                                                </div>
                                                <div class="profile-ud-item">
                                                    <div class="profile-ud wider">
                                                        <span class="profile-ud-label">Responsable</span>
                                                        <span class="profile-ud-value">{{ strtoupper($campus->user->name) ?? "" }}</span>
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
                                                            {{ $campus->description ?? 0 }}
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
                    url: `{{ route('admins.campus.active', $campus->key) }}`,
                    data: {
                        status: status,
                        key: `{{ $campus->key }}`,
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
