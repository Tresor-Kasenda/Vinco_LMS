@extends('backend.layout.base')

@section('title', "Gestion des lecons")

@section('content')
    <div class="container-fluid">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="nk-block-head nk-block-head-sm">
                    <div class="nk-block-between">
                        <div class="nk-block-head-content">
                            <h3 class="nk-block-title page-title">Liste des lecons</h3>
                        </div>
                        <div class="nk-block-head-content">
                            <div class="toggle-wrap nk-block-tools-toggle">
                                <div class="toggle-expand-content" data-content="more-options">
                                    <ul class="nk-block-tools g-3">
                                        <li class="nk-block-tools-opt">
                                            <a class="btn btn-dim btn-primary btn-sm" href="{{ route('admins.academic.lessons.create') }}">
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
                                <span>Cours</span>
                            </th>
                            <th class="nk-tb-col">
                                <span>Chapitre</span>
                            </th>
                            <th class="nk-tb-col">
                                <span>Professeur</span>
                            </th>
                            <th class="nk-tb-col">
                                <span>Titre du lecon</span>
                            </th>
                            <th class="nk-tb-col">
                                <span>Sous description</span>
                            </th>
                            <th class="nk-tb-col nk-tb-col-tools text-center">
                               <span>ACTIONS</span>
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($lessons as $lesson)
                            <tr class="nk-tb-item text-center">
                                <td class="nk-tb-col">
                                    <span class="tb-lead">{{ $lesson->id ?? "" }}</span>
                                </td>
                                <td class="nk-tb-col">
                                    <span class="tb-lead">{{ substr(ucfirst($lesson->chapter->course->name), 0, 20) }}...</span>
                                </td>
                                <td class="nk-tb-col">
                                    <span class="tb-lead">
                                        {{ ucfirst($lesson->chapter->name) }}
                                    </span>
                                </td>
                                <td class="nk-tb-col">
                                    <span class="tb-lead">{{ strtoupper($lesson->chapter->course->user->name)}}</span>
                                </td>
                                <td class="nk-tb-col">
                                    <span class="tb-lead">{{ substr(ucfirst($lesson->name), 0, 15) }}...</span>
                                </td>
                                <td class="nk-tb-col">
                                    <span class="tb-lead">
                                        {{ substr($lesson->shortContent, 0, 20) }}...
                                    </span>
                                </td>
                                <td class="nk-tb-col">
                                        <span class="tb-lead">
                                            <div class="d-flex">
                                                <a href="{{ route('admins.academic.lessons.edit', $lesson->key) }}" class="btn btn-dim btn-primary btn-sm ml-1">
                                                    <em class="icon ni ni-edit"></em>
                                                </a>
                                                    <a href="{{ route('admins.academic.lessons.show', $lesson->key) }}" class="btn btn-dim btn-primary btn-sm ml-1">
                                                    <em class="icon ni ni-eye"></em>
                                                </a>
                                                <form action="{{ route('admins.academic.lessons.destroy', $lesson->key) }}" method="POST" onsubmit="return confirm('Voulez vous supprimer');">
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
