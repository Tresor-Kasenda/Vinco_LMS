@extends('backend.layout.base')

@section('title', "Administration")

@section('content')
    <div class="container-fluid">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="nk-block-head nk-block-head-sm">
                    <div class="nk-block-between">
                        <div class="nk-block-head-content">
                            <h3 class="nk-block-title page-title">
                                Personnel/<strong class="text-primary small">{{ strtoupper($employee->username) }}</strong>
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
                                            <a class="btn btn-outline-light d-none d-md-inline-flex" href="{{ route('admins.personnel.index') }}">
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
                    <div class="card">
                        <div class="card-aside-wrap">
                            <div class="card-inner card-inner-lg">
                                <div class="tab-content">
                                    <div class="tab-pan active" >
                                        <div class="nk-block-head">
                                            <div class="nk-block-between d-flex justify-content-between">
                                                <div class="nk-block-head-content">
                                                    <h4 class="nk-block-title">Personnel Information</h4>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="nk-block">
                                            <div class="nk-data data-list">
                                                <div class="data-head">
                                                    <h6 class="overline-title">Role : {{ strtoupper($employee->user->role->name) }}</h6>
                                                </div>
                                                <div class="data-item">
                                                    <div class="data-col">
                                                        <span class="data-label">Nom</span>
                                                        <span class="data-value">{{ $employee->username ?? "" }}</span>
                                                    </div>
                                                </div>
                                                <div class="data-item">
                                                    <div class="data-col">
                                                        <span class="data-label">Post nom</span>
                                                        <span class="data-value">{{ $employee->firstname ?? "" }}</span>
                                                    </div>
                                                </div>
                                                <div class="data-item">
                                                    <div class="data-col">
                                                        <span class="data-label">Prenom</span>
                                                        <span class="data-value">{{ $employee->lastname ?? "" }}</span>
                                                    </div>
                                                </div>
                                                <div class="data-item">
                                                    <div class="data-col">
                                                        <span class="data-label">Email</span>
                                                        <span class="data-value text-soft">{{ $employee->email ?? "" }}</span>
                                                    </div>
                                                </div>
                                                <div class="data-item">
                                                    <div class="data-col">
                                                        <span class="data-label">Date of Birth</span>
                                                        <span class="data-value">{{ $employee->birthdays ?? "" }}</span>
                                                    </div>
                                                </div>
                                                <div class="data-item">
                                                    <div class="data-col">
                                                        <span class="data-label">N Telephone</span>
                                                        <span class="data-value">{{ $employee->phones ?? "" }}</span>
                                                    </div>
                                                </div>
                                                <div class="data-item">
                                                    <div class="data-col">
                                                        <span class="data-label">Numero Identite</span>
                                                        <span class="data-value">{{ $employee->identityCard ?? "" }}</span>
                                                    </div>
                                                </div>
                                                <div class="data-item">
                                                    <div class="data-col">
                                                        <span class="data-label">Nationality</span>
                                                        <span class="data-value">{{ $employee->nationality ?? "" }}</span>
                                                    </div>
                                                </div>
                                                <div class="data-item" data-tab-target="#address">
                                                    <div class="data-col">
                                                        <span class="data-label">Address</span>
                                                        <span class="data-value">
                                                            {{ $employee->location }}
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-aside card-aside-left user-aside toggle-slide toggle-slide-left toggle-break-lg toggle-screen-lg"
                                 data-content="userAside" data-toggle-screen="lg" data-toggle-overlay="true">
                                <div class="card-inner-group" data-simplebar="init">
                                    <div class="simplebar-wrapper" style="margin: 0px;">
                                        <div class="simplebar-height-auto-observer-wrapper">
                                            <div class="simplebar-height-auto-observer"></div>
                                        </div>
                                        <div class="simplebar-mask">
                                            <div class="simplebar-offset" style="right: 0px; bottom: 0px;">
                                                <div class="simplebar-content-wrapper" tabindex="0" role="region"
                                                     aria-label="scrollable content" style="height: auto; overflow: hidden;">
                                                    <div class="simplebar-content" style="padding: 0px;">
                                                        <div class="card-inner">
                                                            <div class="user-card">
                                                                <div class="user-avatar bg-primary">
                                                                    <img
                                                                        src="{{ asset('storage/'. $employee->images) }}"
                                                                        alt="{{ $employee->firstname }}"
                                                                        class="thumb">
                                                                </div>
                                                                <div class="user-info">
                                                                    <span class="lead-text">
                                                                        {{ $employee->username }}-{{ $employee->lastname }}
                                                                    </span>
                                                                    <span class="sub-text">{{ $employee->email }}</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="card-inner">
                                                            <div class="user-account-info py-0">
                                                                <div class="h5 text-primary">
                                                                    Genre:
                                                                    <small class="currency currency-btc">
                                                                        {{ $employee->gender }}
                                                                    </small>
                                                                </div>
                                                                <div class="h6 text-danger mb-3">
                                                                    N Telephone:
                                                                    <span>
                                                                        <span class="currency currency-btc">{{ $employee->phones }}</span>
                                                                    </span>
                                                                </div>
                                                                <div class="h5 text-primary">
                                                                    Annee academique: <br>
                                                                    <small class="currency currency-btc">
                                                                        {{  \Carbon\Carbon::createFromFormat('Y-m-d', $employee->academic->startDate)->format('Y') }}
                                                                        -
                                                                        {{ \Carbon\Carbon::createFromFormat('Y-m-d', $employee->academic->endDate)->format('Y') }}
                                                                    </small>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="simplebar-placeholder" style="width: auto; height: 551px;"></div>
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
