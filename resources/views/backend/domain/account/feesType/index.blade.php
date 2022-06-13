@extends('backend.layout.base')

@section('title', "Liste des frais entrant")

@section('content')
    <div class="container-fluid">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="nk-block-head nk-block-head-sm">
                    <div class="nk-block-between">
                        <div class="nk-block-head-content">
                            <h3 class="nk-block-title page-title">Incomes Type</h3>
                        </div>
                        <div class="nk-block-head-content">
                            <div class="toggle-wrap nk-block-tools-toggle">
                                <div class="toggle-expand-content" data-content="more-options">
                                    <ul class="nk-block-tools g-3">
                                        <li class="nk-block-tools-opt">
                                            <a class="btn btn-dim btn-primary btn-sm" href="{{ route('admins.announce.feesTypes.create') }}">
                                                <em class="icon ni ni-plus"></em>
                                                <span>Create</span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="nk-block">
                    <div class="row mt-2 g-gs">
                        @forelse($feesTypes as $feesType)
                            <div class="col-md-4 col-xl-3">
                                <div class="card">
                                    <img src="{{ asset('storage/'. $feesType->images) }}" class="card-img-top" alt="">
                                    <div class="card-inner">
                                        <h5 class="card-title">{{ $feesType->name }}</h5>
                                        <div class="text-center d-flex">
                                            <a href="{{ route('admins.announce.feesTypes.edit', $feesType->id) }}" class="btn btn-primary btn-sm">
                                                <em class="icon ni ni-edit"></em>
                                            </a>
                                            <form action="{{ route('admins.announce.feesTypes.destroy', $feesType->id) }}" method="POST" onsubmit="return confirm('Voulez vous supprimer');">
                                                @method('DELETE')
                                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                <button type="submit" class="btn btn-danger btn-sm">
                                                    <em class="icon ni ni-trash"></em>
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="text-center mt-4 text-azure">
                                Pas des sessions disponible
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
