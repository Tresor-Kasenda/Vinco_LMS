@extends('backend.layout.base')

@section('title', "Administration")

@section('content')
    <div class="container-fluid">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                @if($promotion->status == \App\Enums\StatusEnum::FALSE)
                    <div class="alert alert-fill alert-danger alert-icon">
                        <em class="icon ni ni-cross-circle"></em>
                        <strong>promotion activation</strong>!
                        The promotion does not yet active.
                    </div>
                @endif
                <div class="nk-block-head nk-block-head-sm">
                    <div class="nk-block-between">
                        <div class="nk-block-head-content">
                            <h6 class="nk-block-title page-title">
                                Promotion Details
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
                                                        @if($promotion->status == \App\Enums\StatusEnum::FALSE)
                                                            <option value="{{ \App\Enums\StatusEnum::TRUE }}">Activated</option>
                                                        @else
                                                            <option value="{{ \App\Enums\StatusEnum::FALSE }}">Deactivated</option>
                                                        @endif
                                                    </select>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="nk-block-tools-opt">
                                            <a class="btn btn-dim btn-primary btn-sm" href="{{ route('admins.academic.promotion.index') }}">
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
                        <div class="col-md-5">
                            <div class="card">
                                <div class="card-body text-center border-bottom py-3">
                                    <img
                                        @if($promotion->images)
                                            src="{{ asset('storage/'.$promotion->images) }}"
                                        @else
                                            src="{{ asset('assets/admins/images/default.png') }}"
                                        @endif
                                        title="{{ $promotion->name }}"
                                        class="img-fluid user-avatar-xl mb-3 rounded-circle border-danger"
                                    >
                                    <table class="table">
                                        <tbody>
                                        <tr>
                                            <th>Name</th>
                                            <td>{{ $promotion->name ?? "" }}</td>
                                        </tr>
                                        <tr>
                                            <th>Filiaire</th>
                                            <td>{{ strtoupper($promotion->subsidiary->name) ?? "" }}</td>
                                        </tr>
                                        <tr>
                                            <th>Anneee academique</th>
                                            <td>
                                                {{ \Carbon\Carbon::createFromFormat('Y-m-d', $promotion->academic->startDate)->format('Y') }}
                                                -
                                                {{ \Carbon\Carbon::createFromFormat('Y-m-d', $promotion->academic->endDate)->format('Y') }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Description</th>
                                            <td>
                                                {{ $promotion->description ?? "" }}
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
                    url: `{{ route('admins.department.active', $promotion->key) }}`,
                    data: {
                        status: status,
                        key: `{{ $promotion->key }}`,
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
