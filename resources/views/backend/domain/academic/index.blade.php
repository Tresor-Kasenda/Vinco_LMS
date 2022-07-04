@extends('backend.layout.base')

@section('title')
    Annee Academique
@endsection

@section('content')
    <div class="container-fluid">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="nk-block-head nk-block-head-sm">
                    <div class="nk-block-between">
                        <div class="nk-block-head-content">
                            <h3 class="nk-block-title page-title">Annee academique</h3>
                        </div>
                        <div class="nk-block-head-content">
                            <div class="toggle-wrap nk-block-tools-toggle">
                                <div class="toggle-expand-content" data-content="more-options">
                                    <ul class="nk-block-tools g-3">
                                        <li class="nk-block-tools-opt">
                                            <a class="btn btn-dim btn-primary btn-sm" href="{{ route('admins.academic.session.create') }}">
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
                    <div class="row g-gs">
                        @forelse($academics as $academic)
                            <div class="col-sm-6 col-lg-3 col-xxl-3">
                                <div class="card h-100">
                                    <div class="card-inner">
                                        <h3 class="text-center text-gray h4 font-weight-light mb-3">Session</h3>
                                        <div class="text-center font-weight-bold">
                                            <h5>
                                                {{ \Carbon\Carbon::createFromFormat('Y-m-d', $academic->start_date)->format('Y') }}
                                                -
                                                {{ \Carbon\Carbon::createFromFormat('Y-m-d', $academic->end_date)->format('Y') }}
                                            </h5>
                                        </div>

                                        <div class="d-flex justify-content-center mt-3">
                                            <a class="-mr-2 btn btn-dim btn-primary ml-2" href="{{ route('admins.academic.session.edit', $academic->id) }}">
                                                <em class="icon ni ni-edit"></em>
                                            </a>
                                            <form action="{{ route('admins.academic.session.destroy', $academic->id) }}" method="POST" onsubmit="return confirm('Voulez vous supprimer');">
                                                @method('DELETE')
                                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                <button type="submit" class="btn btn-dim btn-danger">
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
