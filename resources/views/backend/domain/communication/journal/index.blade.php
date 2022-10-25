@extends('backend.layout.communication')

@section('title', "Journal De Classe")

@section('content')
    <div class="container-fluid">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="nk-block-head nk-block-head-sm">
                    <div class="nk-block-between">
                        <div class="nk-block-head-content">
                            <h3 class="nk-block-title page-title">Journal De Classe</h3>
                        </div>
                        <div class="nk-block-head-content">
                            @can('journal-create')
                            <a class="btn btn-primary" href="{{ route('admins.communication.journal.create') }}">
                                <em class="icon ni ni-plus"></em>
                                <span>Add</span>
                            </a>
                            @endcan
                        </div>
                    </div>
                </div>
                <div class="nk-block">
                    <div class="row">
                        <div class="col-md-7">
                            <div class="card">
                                <div class="card-inner">
                                    {!! $calendar->calendar() !!}
                                </div>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="card">
                                <div class="card-inner">
                                    <h5 class="card-title">Liste des calendriers</h5>
                                    <ul class="link-list-plain">
                                        @foreach($eloquentEvent as $event)
                                            <li>
                                                <div class="d-flex">
                                                    <a href="#">
                                                        <span>{{ ucfirst($event->title) ?? "" }}</span>
                                                        @can('journal-update')
                                                        <a href="{{ route('admins.communication.journal.edit', $event->id) }}" class="btn btn-dim btn-success">
                                                            <em class="icon ni ni-edit-alt"></em>
                                                        </a>
                                                        @endcan

                                                        @can('journal-delete')
                                                        <form action="{{ route('admins.communication.journal.destroy', $event->id) }}">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-dim btn-danger">
                                                                <em class="icon ni ni-trash-alt"></em>
                                                            </button>
                                                        </form>
                                                        @endcan
                                                    </a>
                                                </div>

                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    {!! $calendar->script() !!}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.js"></script>
@endsection
