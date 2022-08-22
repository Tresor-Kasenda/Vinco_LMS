@php use App\Models\FeeType;use App\Models\Institution;use App\Models\Promotion; @endphp
@extends('backend.layout.base')

@section('title')
    Liste des paiements
@endsection

@section('content')
    <div class="container-fluid">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="nk-block-head nk-block-head-sm">
                    <div class="nk-block-between">
                        <div class="nk-block-head-content">
                            <h3 class="nk-block-title page-title">Ajouter le paiement</h3>
                        </div>
                        <div class="nk-block-head-content">
                            <div class="toggle-wrap nk-block-tools-toggle">
                                <div class="toggle-expand-content" data-content="more-options">
                                    <ul class="nk-block-tools g-3">
                                        <li class="nk-block-tools-opt">
                                            <a class="btn btn-dim btn-primary btn-sm"
                                               href="{{ route('admins.accounting.fees.index') }}">
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
                    <div class="card">
                        <div class="card-inner">
                            <div class="row justify-content-center">
                                <div class="col-md-6">
                                    @if ($errors->any())
                                        <div class="alert alert-danger">
                                            <ul>
                                                @foreach ($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif
                                    <form action="{{ route('admins.accounting.fees.store') }}" method="post"
                                          class="form-validate mt-4" novalidate="novalidate">
                                        @csrf
                                        <div class="row g-gs">
                                            @php
                                                if(auth()->user()->hasRole('Super Admin'))  {
                                                    $institutions = \App\Models\Institution::query()
                                                        ->select([
                                                            'id',
                                                            'institution_name'
                                                        ])
                                                        ->get();
                                                    $fees = \App\Models\FeeType::query()
                                                        ->select(['id', 'name', 'institution_id'])
                                                        ->get();
                                                } else {
                                                    $promotions = \App\Models\Promotion::query()
                                                        ->select(['id', 'name', 'subsidiary_id'])
                                                        ->whereHas('subsidiary', function ($query) {
                                                            $query->whereHas('department', function ($query) {
                                                                $query->whereHas('campus', function ($query) {
                                                                    $query->where('institution_id', auth()->user()->institution->id);
                                                                });
                                                            });
                                                        })
                                                        ->get();
                                                    $fees = FeeType::query()
                                                        ->select(['id', 'name', 'institution_id'])
                                                        ->where('institution_id', '=', auth()->user()->institution->id)
                                                        ->get();
                                                }
                                            @endphp

                                            @if(auth()->user()->hasRole('Super Admin'))
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label class="form-label" for="institution">Institution</label>
                                                        <select
                                                            class="form-control js-select2 select2-hidden-accessible @error('institution') error @enderror"
                                                            id="institution"
                                                            name="institution"
                                                            data-search="on"
                                                            data-placeholder="Select Institution"
                                                            required>
                                                            <option label="role" value=""></option>
                                                            @foreach($institutions as $personnel)
                                                                <option
                                                                    value="{{ $personnel->id }}">
                                                                    {{ ucfirst($personnel->institution_name) ?? "" }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label class="form-label" for="promotion">Promotion</label>
                                                        <div class="form-control-wrap">
                                                            <select
                                                                class="form-control js-select2 select2-hidden-accessible @error('class') error @enderror"
                                                                id="promotion"
                                                                name="promotion"
                                                                data-search="on"
                                                                data-placeholder="Select Promotion"
                                                            >

                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            @else
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label class="form-label" for="promotion">Promotion</label>
                                                        <div class="form-control-wrap">
                                                            <select
                                                                class="form-control js-select2 select2-hidden-accessible @error('class') error @enderror"
                                                                id="promotion"
                                                                name="promotion"
                                                                data-search="on"
                                                                data-placeholder="Select Promotion"
                                                            >
                                                                <option label="select Fees" value=""></option>
                                                                @foreach($promotions as $promotion)
                                                                    <option
                                                                        value="{{ $promotion->id }}">
                                                                        {{ ucfirst($promotion->name) ?? "" }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif

                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label class="form-label" for="types">Fee Type</label>
                                                    <select
                                                        class="form-control js-select2 @error('types') error @enderror"
                                                        id="types"
                                                        name="types"
                                                        data-placeholder="Select Type"
                                                        required>
                                                        <option label="Select Type" value=""></option>
                                                        @foreach($fees as $type)
                                                            <option
                                                                value="{{ $type->id }}">{{ ucfirst($type->name) ?? "" }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label class="form-label" for="amount">Montant</label>
                                                    <div class="form-control-wrap">
                                                        <input
                                                            type="text"
                                                            class="form-control @error('amount') error @enderror"
                                                            id="amount"
                                                            name="amount"
                                                            value="{{ old('amount') }}"
                                                            placeholder="Saisir le montant"
                                                            required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label class="form-label" for="pay_date">Date de paiement</label>
                                                    <div class="form-control-wrap">
                                                        <input
                                                            type="text"
                                                            class="form-control date-picker @error('pay_date') error @enderror"
                                                            id="pay_date"
                                                            name="pay_date"
                                                            value="{{ old('pay_date') }}"
                                                            data-date-format="yyyy-mm-dd"
                                                            placeholder="Saisir la date de paiement"
                                                            required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label class="form-label" for="description">Description</label>
                                                    <div class="form-control-wrap">
                                                        <textarea
                                                            class="form-control form-control-sm @error('description') error @enderror"
                                                            id="description"
                                                            name="description"
                                                            placeholder="Write the description"
                                                        >{{ old('description') }}</textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <button type="submit" class="btn btn-md btn-primary">Save</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
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
            $('#institution').change(function () {
                let institution = $(this).val();
                if (institution){
                    $.ajax({
                        type:'GET',
                        url:'{{ route("admins.accounting.promotion-fee-json") }}',
                        data:{"institution" : institution },
                        success:function(response){
                            $("#promotion").empty();
                            $("#promotion").append('<option label="Select Promotion" value=""></option>');
                            if(response && response?.status === 'success'){
                                response?.promotions?.map((promotion) => {
                                    $("#promotion").append('<option value="'+promotion.id+'">'+promotion.name+'</option>');
                                })
                            }
                        }
                    })
                }
            });
        })
    </script>
@endsection
