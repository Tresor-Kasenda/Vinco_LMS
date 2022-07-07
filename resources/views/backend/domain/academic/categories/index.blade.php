@extends('backend.layout.base')

@section('title')
    Categories Lists
@endsection

@section('content')
    <div class="container-fluid">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="nk-block-head nk-block-head-sm">
                    <div class="nk-block-between">
                        <div class="nk-block-head-content">
                            <h3 class="nk-block-title page-title">Categories</h3>
                        </div>
                        <div class="nk-block-head-content">
                            <div class="toggle-wrap nk-block-tools-toggle">
                                <div class="toggle-expand-content" data-content="more-options">
                                    <ul class="nk-block-tools g-3">
                                        <li class="nk-block-tools-opt">
                                            <a class="btn btn-dim btn-primary btn-sm" href="{{ route('admins.academic.categories.create') }}">
                                                <em class="icon ni ni-plus"></em>
                                                <span>Create</span>
                                            </a>
                                        </li>
                                        <li class="nk-block-tools-opt">
                                            <a class="btn btn-dim btn-secondary btn-sm" href="{{ route('admins.categories.history') }}">
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
                    @if($categories)
                        <div class="row">
                            @foreach($categories as $category)
                                <div class="col-md-3">
                                    <div class="card">
                                        <div class="card-inner">
                                            <h5 class="card-title text-center mb-4">{{ ucfirst($category->name) ?? " " }}</h5>
                                            <p class="card-text">
                                                {{ $category->description ?? "" }}
                                            </p>
                                            <div class="d-flex justify-content-center mt-3">
                                                <a class="-mr-2 btn btn-dim btn-primary ml-2" href="{{ route('admins.academic.categories.edit', $category->id) }}">
                                                    <em class="icon ni ni-edit"></em>
                                                </a>
                                                <form action="{{ route('admins.academic.categories.destroy', $category->id) }}" method="POST" onsubmit="return confirm('Voulez vous supprimer');">
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
                            @endforeach
                        </div>
                    @else
                        <div class="alert alert-icon alert-primary" role="alert">
                            <em class="icon ni ni-alert-circle"></em>
                            <strong>Informations</strong>.
                            Les categories n'exite pas pour l'instant .
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
