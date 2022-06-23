@extends('backend.layout.base')

@section('title')
    Fee Type Listen
@endsection

@section('content')
    <div class="container-fluid">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="nk-block-head nk-block-head-sm">
                    <div class="nk-block-between">
                        <div class="nk-block-head-content">
                            <h3 class="nk-block-title page-title">Fee Type Listen</h3>
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
                            <div class="col-sm-6 col-lg-4 col-xxl-3">
                                <div class="gallery card">
                                    <img
                                        class="w-100 rounded-top"
                                        src="{{ asset('storage/'.$feesType->images) }}"
                                        alt="{{ $feesType->name }}">
                                    <div class="gallery-body card-inner align-center justify-between flex-wrap g-2">
                                        <h6>{{ ucfirst($feesType->name) }}</h6>
                                        <div class="user-card">
                                            <a href="{{ route('admins.announce.feesTypes.edit', $feesType->id) }}" class="btn btn-outline-primary btn-dim">
                                                <em class="icon ni ni-edit"></em>
                                            </a>
                                        </div>
                                        <div>
                                            <form method="post" action="{{ route('admins.announce.feesTypes.destroy', $feesType->id) }}">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-outline-danger btn-dim">
                                                    <em class="icon ni ni-trash"></em>
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="text-center mt-4 text-azure">
                                Pas des frais disponibles
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
