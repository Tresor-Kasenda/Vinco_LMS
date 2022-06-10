@extends('backend.layout.base')

@section('title', "Gestion des exercises")

@section('content')
    <div class="container-fluid">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="nk-block-head nk-block-head-sm">
                    <div class="nk-block-between">
                        <div class="nk-block-head-content">
                            <h3 class="nk-block-title page-title">Liste des Exercices</h3>
                        </div>
                        <div class="nk-block-head-content">
                            <div class="toggle-wrap nk-block-tools-toggle">
                                <div class="toggle-expand-content" data-content="more-options">
                                    <ul class="nk-block-tools g-3">
                                        <li class="nk-block-tools-opt">
                                            <a class="btn btn-dim btn-primary btn-sm" href="{{ route('admins.academic.exercice.create') }}">
                                                <em class="icon ni ni-plus"></em>
                                                <span>Create</span>
                                            </a>
                                        </li>
                                        <li class="nk-block-tools-opt">
                                            <a class="btn btn-dim btn-secondary btn-sm" href="{{ route('admins.course.history') }}">
                                                <em class="icon ni ni-histroy"></em>
                                                <span>Corbeille</span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="nk-block">
                    <table class="datatable-init nowrap nk-tb-list is-separate" data-auto-responsive="false">
                        <thead>
                        <tr class="nk-tb-item nk-tb-head text-center">
                            <th class="nk-tb-col">
                                <span>Numero</span>
                            </th>
                            <th class="nk-tb-col">
                                <span>Titre du chapitre</span>
                            </th>
                            <th class="nk-tb-col">
                                <span>Lesson</span>
                            </th>
                            <th class="nk-tb-col">
                                <span>Professeur</span>
                            </th>
                            <th class="nk-tb-col">
                                <span>Date de depot</span>
                            </th>
                            <th class="nk-tb-col">
                                <span>Ponderation</span>
                            </th>
                            <th class="nk-tb-col">
                                <span>ACTION</span>
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($exercises as $exercise)
                            <tr class="nk-tb-item text-center">
                                <td class="nk-tb-col">
                                    <span class="tb-lead">{{ $exercise->id ?? "" }}</span>
                                </td>
                                <td class="nk-tb-col">
                                    <span class="tb-lead">{{ ucfirst($exercise->name) }}</span>
                                </td>
                                <td class="nk-tb-col">
                                    <span class="tb-lead">
                                        {{ ucfirst($exercise->lesson->name) }}
                                    </span>
                                </td>
                                <td class="nk-tb-col">
                                    <span class="tb-lead">
                                        {{ strtoupper($exercise->course->user->name) }}
                                    </span>
                                </td>
                                <td class="nk-tb-col">
                                    <span class="tb-lead">
                                        {{ $exercise->schedule }}
                                    </span>
                                </td>
                                <td class="nk-tb-col">
                                    <span class="tb-lead">
                                        {{ $exercise->weighting }}
                                    </span>
                                </td>
                                <td class="nk-tb-col">
                                        <span class="tb-lead">
                                            <div class="d-flex">
                                                <a href="{{ route('admins.academic.exercice.edit', $exercise->key) }}" class="btn btn-dim btn-primary btn-sm ml-1">
                                                    <em class="icon ni ni-edit"></em>
                                                </a>
                                                    <a href="{{ route('admins.academic.exercice.show', $exercise->key) }}" class="btn btn-dim btn-primary btn-sm ml-1">
                                                    <em class="icon ni ni-eye"></em>
                                                </a>
                                                <form action="{{ route('admins.academic.exercice.destroy', $exercise->key) }}" method="POST" onsubmit="return confirm('Voulez vous supprimer');">
                                                    @method('DELETE')
                                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                    <button type="submit" class="btn btn-dim btn-danger btn-sm">
                                                        <em class="icon ni ni-trash"></em>
                                                    </button>
                                                </form>
                                            </div>
                                        </span>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
