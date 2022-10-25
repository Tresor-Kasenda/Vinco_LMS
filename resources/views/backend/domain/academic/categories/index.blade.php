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
                                        @can('category-create')
                                            <li class="nk-block-tools-opt">
                                                <a class="btn btn-outline-primary btn-sm" href="{{ route('admins.academic.categories.create') }}">
                                                    <em class="icon ni ni-plus"></em>
                                                    <span>Create</span>
                                                </a>
                                            </li>
                                        @endcan
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="nk-block">
                    <div class="row">
                        @foreach($categories as $category)
                            <div class="col-md-3">
                                <div class="card">
                                    <div class="card-inner">
                                        <h5 class="card-title text-center mb-4">{{ ucfirst($category->name) ?? " " }}</h5>
                                        @if(auth()->user()->hasRole('Super Admin'))
                                            <h6 class="card-title text-center mb-4 mt-4">
                                                {{ ucfirst($category->institution->institution_name) ?? " " }}
                                            </h6>
                                        @endif
                                        <p class="card-text">
                                            {{ $category->description ?? "" }}
                                        </p>
                                        <div class="d-flex justify-content-center mt-3 mr-2">
                                            @can('category-update')
                                            <a class="-mr-2 btn btn-outline-primary mr-2" href="{{ route('admins.academic.categories.edit', $category->id) }}">
                                                <em class="icon ni ni-edit"></em>
                                            </a>
                                            @endcan
                                            @can('category-delete')
                                            <form action="{{ route('admins.academic.categories.destroy', $category->id) }}" method="POST" onsubmit="return confirm('Voulez vous supprimer');">
                                                @method('DELETE')
                                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                <button type="submit" class="btn btn-outline-danger">
                                                    <em class="icon ni ni-trash"></em>
                                                </button>
                                            </form>
                                            @endcan
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
