@extends('backend.layout.base')

@section('title')
    Detail exercice
@endsection

@section('content')
    <div class="container-fluid">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="nk-block-head nk-block-head-sm">
                    <div class="nk-block-between">
                        <div class="nk-block-head-content">
                            <h6 class="nk-block-title page-title">
                                Exercise Details
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
                                                        @if($exercise->status == \App\Enums\StatusEnum::FALSE)
                                                            <option value="{{ \App\Enums\StatusEnum::TRUE }}">Activated</option>
                                                        @else
                                                            <option value="{{ \App\Enums\StatusEnum::FALSE }}">Deactivated</option>
                                                        @endif
                                                    </select>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="nk-block-tools-opt">
                                            <a class="btn btn-dim btn-primary btn-sm" href="{{ route('admins.academic.exercice.index') }}">
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
                            @if($exercise->status == \App\Enums\StatusEnum::FALSE)
                                <div class="alert alert-danger alert-icon">
                                    <em class="icon ni ni-cross-circle"></em>
                                    <strong>Exercice activation</strong>!
                                    The Exercice does not yet active.
                                </div>
                            @endif
                            <div class="card">
                                <div class="card-body border-bottom py-3">
                                    <div class="text-center">
                                        <img
                                            @if($exercise->course->images)
                                                src="{{ asset('storage/'.$exercise->course->images) }}"
                                            @else
                                                src="{{ asset('assets/admins/images/default.png') }}"
                                            @endif
                                            title="{{ $exercise->name }}"
                                            class="img-fluid user-avatar-xl mb-3 rounded-circle border-danger"
                                        >
                                    </div>
                                    <table class="table">
                                        <tbody>
                                        <tr></tr>
                                        <tr>
                                            <th>Cours</th>
                                            <td>{{ ucwords($exercise->course->name) ?? "" }}</td>
                                        </tr>
                                        <tr>
                                            <th>Chapitre</th>
                                            <td>{{ ucwords($exercise->chapter->name) ?? "" }}</td>
                                        </tr>
                                        <tr>
                                            <th>Title du lecon</th>
                                            <td>{{ ucfirst($exercise->lesson->name) ?? "" }}</td>
                                        </tr>
                                        <tr>
                                            <th>Title d'exerice</th>
                                            <td>{{ ucfirst($exercise->name) ?? "" }}</td>
                                        </tr>
                                        <tr>
                                            <th>Ponderation</th>
                                            <td>{{ ucfirst($exercise->rating) ?? "" }}</td>
                                        </tr>
                                        <tr>
                                            <th>Date de depot</th>
                                            <td>{{ ucfirst($exercise->filling_date) ?? "" }}</td>
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
