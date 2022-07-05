@extends('backend.layout.base')

@section('title')
    Parent Detail
@endsection

@section('content')
    <div class="container-fluid">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="nk-block-head nk-block-head-sm">
                    <div class="nk-block-between">
                        <div class="nk-block-head-content">
                            <h3 class="nk-block-title page-title">
                                Show Parent
                            </h3>
                        </div>
                        <div class="nk-block-head-content">
                            <div class="toggle-wrap nk-block-tools-toggle">
                                <div class="toggle-expand-content" data-content="more-options">
                                    <ul class="nk-block-tools g-3">
                                        <li class="nk-block-tools-opt">
                                            <a class="btn btn-outline-light d-none d-md-inline-flex" href="{{ route('admins.users.guardian.index') }}">
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
                            <div class="card">
                                <div class="card-body border-bottom py-3">
                                    <div class="text-center">
                                        <img
                                            @if($parent->images)
                                                src="{{ asset('storage/'.$parent->images) }}"
                                            @else
                                                src="{{ asset('assets/admins/images/man.webp') }}"
                                            @endif
                                            title="{{ $parent->name_guardian }}"
                                            class="img-fluid user-avatar-xl mb-3 text-center rounded-circle border-danger"
                                        >
                                    </div>
                                    <table class="table">
                                        <tbody>
                                        <tr>
                                            <th>Name</th>
                                            <td class="justify-content-center">{{ ucfirst($parent->name_guardian) ?? "-" }}</td>
                                        </tr>
                                        <tr>
                                            <th>Last-Name</th>
                                            <td class="justify-content-center">{{ ucfirst($parent->firstName_guardian) ?? "-" }}</td>
                                        </tr>
                                        <tr>
                                            <th>Email</th>
                                            <td class="justify-content-center">{{ $parent->email_guardian ?? "-" }}</td>
                                        </tr>
                                        <tr class="text-justify">
                                            <th>Phones</th>
                                            <td class="justify-content-center">{{ $parent->phones ?? "-" }}</td>
                                        </tr>
                                        <tr class="text-justify">
                                            <th>Occupation</th>
                                            <td class="justify-content-center">  {{ $parent->occupation ?? "-" }}</td>
                                        </tr>

                                        <tr class="text-justify">
                                            <th>Admission</th>
                                            <td class="justify-content-center">{{ $parent->created_at->format('M, d Y') ?? "-" }}</td>
                                        </tr>
                                        <tr>
                                            <th>Genre</th>
                                            <td>
                                                @if($parent->gender == 'male')
                                                    MASCULIN
                                                @else
                                                    FEMININ
                                                @endif
                                            </td>
                                        </tr>
                                        <tr class="text-justify">
                                            <th>Roles</th>
                                            <td>
                                                <div class="tb-lead d-flex flex-wrap">
                                                    @foreach($parent->user->roles as $role)
                                                        <span class="badge bg-primary mx-1 mb-1">{{$role->name ?? "-" }}</span>
                                                    @endforeach
                                                </div>
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
