@extends('backend.layout.base')

@section('title')
    Homework Detail
@endsection

@section('content')
    <div class="container-fluid">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="nk-block-head nk-block-head-sm">
                    <div class="nk-block-between">
                        <div class="nk-block-head-content">
                            <h3 class="nk-block-title page-title">Devoir du devoir</h3>
                        </div>
                        <div class="nk-block-head-content">
                            <div class="toggle-wrap nk-block-tools-toggle">
                                <div class="toggle-expand-content" data-content="more-options">
                                    <ul class="nk-block-tools g-3">
                                        @can('homework-status')
                                            <li class="preview-item">
                                                <div class="custom-control custom-control-md custom-switch">
                                                    <input
                                                        type="checkbox"
                                                        class="custom-control-input"
                                                        name="activated"
                                                        data-id="{{ $homework->id }}"
                                                        {{ $homework->status ? "checked" : "" }}
                                                        onclick="changeCampusStatus(event.target, {{ $homework->id }});"
                                                        id="activated">
                                                    <label class="custom-control-label" for="activated"></label>
                                                </div>
                                            </li>
                                        @endcan
                                        <li class="preview-item">
                                            <a class="btn btn-outline-primary btn-sm" href="{{ route('admins.academic.homework.index') }}">
                                                <em class="icon ni ni-arrow-long-left"></em>
                                                <span>Touts les campus</span>
                                            </a>
                                        </li>
                                        @can('homework-update')
                                            <li class="preview-item">
                                                <a
                                                    href="{{ route('admins.academic.homework.edit', $homework->id) }}"
                                                    class="btn btn-outline-primary btn-sm">
                                                    <em class="icon ni ni-edit mr-1"></em>
                                                    Editer
                                                </a>
                                            </li>
                                        @endcan
                                        @can('homework-delete')
                                            <li class="preview-item">
                                                <form
                                                    action="{{ route('admins.academic.homework.destroy', $homework->id) }}"
                                                    method="POST"
                                                    class="d-inline-block"
                                                    onsubmit="return confirm('Are you sure you want to delete this item?');"
                                                >
                                                    @method('DELETE')
                                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                    <button type="submit" class="btn btn-outline-danger btn-sm">
                                                        <em class="icon ni ni-trash-empty-fill"></em>
                                                        Delete le campus
                                                    </button>
                                                </form>
                                            </li>
                                        @endcan
                                    </ul>
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
                                            @if($homework->course->images)
                                                src="{{ asset('storage/'.$homework->course->images) }}"
                                            @else
                                                src="{{ asset('assets/admins/images/default.png') }}"
                                            @endif
                                            title="{{ $homework->name }}"
                                            class="img-fluid user-avatar-xl mb-3 text-center rounded-circle border-danger"
                                        >
                                    </div>
                                    <table class="table">
                                        <tbody>
                                        <tr>
                                            <th>Nom du cours</th>
                                            <td>{{ ucfirst($homework->course->name) ?? "" }}</td>
                                        </tr>
                                        <tr>
                                            <th>chapitres</th>
                                            <td>
                                                {{ ucfirst($homework->chapter->name) }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Lecon</th>
                                            <td>
                                                {{ ucfirst($homework->lesson->name) }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Titre du devoir (TP)</th>
                                            <td>{{ $homework->name ?? "" }}</td>
                                        </tr>
                                        <tr>
                                            <th>Ponderation</th>
                                            <td>{{ $homework->rating_homework ?? "" }}</td>
                                        </tr>
                                        <tr>
                                            <th>Date depot</th>
                                            <td>{{ $homework->filling_date ?? "" }}</td>
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
