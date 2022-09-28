@extends('backend.layout.communication')

@section('title', "Notification")

@section('content')
    <div class="container-fluid">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="nk-block-head nk-block-head-sm">
                    <div class="nk-block-between">
                        <div class="nk-block-head-content">
                            <h3 class="nk-block-title page-title">Book List</h3>
                        </div>
                    </div>
                </div>
                <div class="nk-block">
                    <table class="datatable-init nowrap nk-tb-list is-separate" data-auto-responsive="false">
                        <thead>
                        <tr class="nk-tb-item nk-tb-head text-center">
                            <th class="nk-tb-col">
                                <span>TITLE</span>
                            </th>
                            <th class="nk-tb-col">
                                <span>CONTENT</span>
                            </th>
                            <th class="nk-tb-col nk-tb-col-tools text-center">
                                <span>ACTIONS</span>
                            </th>
                        </tr>
                        </thead>
                        <tbody>
{{--                        @foreach($notifications as $notification)--}}
{{--                            <tr class="nk-tb-item text-center">--}}
{{--                                <td class="nk-tb-col">--}}
{{--                                    <span class="tb-lead">{{ ucfirst($notification->title) ?? "" }}</span>--}}
{{--                                </td>--}}
{{--                                <td class="nk-tb-col">--}}
{{--                                    <span class="tb-lead">{{ $notification->content ?? "" }}</span>--}}
{{--                                </td>--}}
{{--                                <td class="nk-tb-col">--}}
{{--                                    <span class="tb-lead">--}}
{{--                                        <div class="d-flex">--}}
{{--                                                <a href="{{ route('admins.communication.notification.edit', $notification->id) }}" class="btn btn-dim btn-primary btn-sm ml-1">--}}
{{--                                                    <em class="icon ni ni-edit"></em>--}}
{{--                                                </a>--}}
{{--                                                <form action="{{ route('admins.communication.notification.destroy', $notification->id) }}" method="POST" onsubmit="return confirm('Voulez vous supprimer');">--}}
{{--                                                    @method('DELETE')--}}
{{--                                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">--}}
{{--                                                    <button type="submit" class="btn btn-dim btn-danger btn-sm">--}}
{{--                                                        <em class="icon ni ni-trash"></em>--}}
{{--                                                    </button>--}}
{{--                                                </form>--}}
{{--                                            </div>--}}
{{--                                    </span>--}}
{{--                                </td>--}}
{{--                            </tr>--}}
{{--                        @endforeach--}}
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
