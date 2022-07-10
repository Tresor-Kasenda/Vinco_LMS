@extends('backend.layout.base')

@section('title')
    Show Department
@endsection

@section('content')
    <div class="container-fluid">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="nk-block-head nk-block-head-sm">
                    <div class="nk-block-between">
                        <div class="nk-block-head-content">
                            <h3 class="nk-block-title page-title">
                                Show Department
                            </h3>
                        </div>

                        <div class="nk-block-head-content">
                            <div class="toggle-wrap nk-block-tools-toggle">
                                <div class="toggle-expand-content" data-content="more-options">
                                    <ul class="nk-block-tools g-3">
                                        <li>
                                            <div class="drodown">
                                                <div class="form-control-wrap">
                                                    <select name="status" id="status"
                                                            class="form-select form-control form-control-sm">
                                                        <option value="default_option">Select Status</option>
                                                        @if($department->isInactive() == \App\Enums\StatusEnum::FALSE)
                                                            <option value="{{ \App\Enums\StatusEnum::TRUE }}">
                                                                Activated
                                                            </option>
                                                        @else
                                                            <option value="{{ \App\Enums\StatusEnum::FALSE }}">
                                                                Deactivated
                                                            </option>
                                                        @endif
                                                    </select>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="nk-block-tools-opt">
                                            <a class="btn btn-outline-light d-none d-md-inline-flex"
                                               href="{{ route('admins.academic.departments.index') }}">
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
                            @if($department->isInactive() == \App\Enums\StatusEnum::FALSE)
                                <div class="alert alert-danger alert-icon " role="alert">
                                    <em class="icon ni ni-bell"></em>
                                    Le campus n'est pas encore confirmer
                                </div>
                            @endif
                            <div class="card">
                                <div class="card-body border-bottom py-3">
                                    <div class="text-center">
                                        <img
                                            @if($department->images)
                                                src="{{ asset('storage/'.$department->images) }}"
                                            @else
                                                src="{{ asset('assets/admins/images/man.webp') }}"
                                            @endif
                                            title="{{ $department->name }}"
                                            class="img-fluid user-avatar-xl mb-3 text-center rounded-circle border-danger"
                                        >
                                    </div>
                                    <table class="table">
                                        <tbody>
                                        <tr>
                                            <th>Nom du Campus</th>
                                            <td>{{ ucfirst($department->campus->name) ?? "" }}</td>
                                        </tr>
                                        <tr>
                                            <th>Institution</th>
                                            <td class="font-weight-bold">{{ ucfirst($department->campus->institution->institution_name) ?? "" }}</td>
                                        </tr>
                                        <tr>
                                            <th>Responsable du Departement</th>
                                            <td>
                                                @foreach($department->users as $user)
                                                    {{ ucfirst($user->name) ?? "" }}
                                                @endforeach
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Email du Responsable</th>
                                            <td>
                                                @foreach($department->users as $user)
                                                    {{ ucfirst($user->email) ?? "" }}
                                                @endforeach
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Description</th>
                                            <td>{{ $campus->description ?? "-" }}</td>
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
