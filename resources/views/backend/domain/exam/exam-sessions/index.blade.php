@extends('backend.layout.base')

@section('title')
    Sessions d'examen
@endsection

@section('content')
    <div class="container-fluid">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="nk-block-head nk-block-head-sm">
                    <div class="nk-block-between">
                        <div class="nk-block-head-content">
                            <h3 class="nk-block-title page-title">Session d'examen</h3>
                        </div>
                        <div class="nk-block-head-content">
                            <div class="toggle-wrap nk-block-tools-toggle">
                                <div class="toggle-expand-content" data-content="more-options">
                                    <ul class="nk-block-tools g-3">
                                        <li class="nk-block-tools-opt">
                                            <a class="btn btn-dim btn-primary btn-sm" href="{{ route('admins.exam.session-exams.create') }}">
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
                    <div class="row">
                        @forelse($sessionExams as $sessionExam)
                            <div class="col-sm-6 col-lg-3 col-xxl-3">
                                <div class="card h-100">
                                    <div class="card-inner">
                                        <div class="text-center mb-4">
                                        <span class="font-weight-light h5">
                                            {{ ucfirst($sessionExam->name) ?? "" }}
                                        </span>
                                        </div>
                                        <div class="text-center font-weight-bold">
                                            <h6>
                                                {{ \Carbon\Carbon::createFromFormat('Y-m-d', $sessionExam->start_date)->format('d, M') }}
                                                -
                                                {{ \Carbon\Carbon::createFromFormat('Y-m-d', $sessionExam->end_date)->format('d, M') }}
                                            </h6>
                                        </div>

                                        <p class="mt-2 text-center mt-2">
                                            {{ ucfirst($sessionExam->note) ?? "" }}
                                        </p>

                                        <div class="d-flex justify-content-center mt-3">
                                            <a class="-mr-2 btn btn-dim btn-primary ml-2" href="{{ route('admins.exam.session-exams.edit', $sessionExam->id) }}">
                                                <em class="icon ni ni-edit"></em>
                                            </a>
                                            <form action="{{ route('admins.exam.session-exams.destroy', $sessionExam->id) }}" method="POST" onsubmit="return confirm('Voulez vous supprimer');">
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
                                Pas des sessions d'examen disponible
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
