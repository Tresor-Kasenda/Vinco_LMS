<!DOCTYPE html>
<html lang="zxx" class="js">
<meta http-equiv="content-type" content="text/html;charset=UTF-8"/><!-- /Added by HTTrack -->
<head>
    <meta charset="utf-8">
    <meta name="author" content="Softnio">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description"
          content="A powerful and conceptual apps base dashboard template that especially build for developers and programmers.">
    <link rel="shortcut icon" href="images/favicon.png">
    <title>Group Chat</title>
    <link rel="stylesheet" href="{{asset('assets/admins/css/css/dashlite41fe.css')}}">
    <link id="skin-default" rel="stylesheet" href="{{asset('assets/admins/css/css/theme41fe.css')}}">
</head>
<body class="nk-body bg-lighter npc-default has-sidebar ">
<div class="nk-app-root">
    <div class="nk-main ">
        <div class="nk-wrap ">
            <div class="nk-content p-0">
                <div class="nk-content-inner">
                    <div class="nk-content-body">
                        <div class="nk-chat">
                            <div class="nk-chat-body show-chat">
                                <div class="nk-chat-head">
                                    <ul class="nk-chat-head-info">
                                        <li class="nk-chat-body-close"><a href="#"
                                                                          class="btn btn-icon btn-trigger nk-chat-hide ms-n1"><em
                                                    class="icon ni ni-arrow-left"></em></a></li>
                                        <li class="nk-chat-head-user">
                                            <div class="user-card">
                                                <div class="user-avatar bg-purple"><span>{{ strlen($group->name) > 2 ? trim(substr($group->name,0,2)): $group->name }}</span></div>
                                                <div class="user-info">
                                                    <div class="lead-text">{{$group->name}}</div>
                                                    <div class="sub-text"><span
                                                            class="d-none d-sm-inline me-1">Code to join: {{$group->code}} </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                    <ul class="nk-chat-head-tools">
                                        <li><a href="{{url('./chatify')}}" class="btn btn-icon btn-trigger text-primary"><em
                                                    class="icon ni ni-home-fill"></em></a></li>
                                    </ul>
                                </div>
                                <div class="nk-chat-panel" data-simplebar>
                                    @forelse($messages as $message)
                                        @if($message->user->id == auth()->user()->id)
                                            <div class="chat is-me">
                                                <div class="chat-content">
                                                    <div class="chat-bubbles">
                                                        <div class="chat-bubble">
                                                            <div class="chat-msg">
                                                                {{$message->message}}
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <ul class="chat-meta">
                                                        <li>{{$message->user->name}}</li>
                                                        <li>{{$message->created_at}}</li>
                                                    </ul>
                                                </div>
                                            </div>
                                        @else
                                            <div class="chat is-you">
                                                <div class="chat-avatar">
                                                    <div class="chat-media user-avatar">
                                                        <img class="h-100 w-100" src="{{asset('storage/users-avatar/' . $message->user->avatar)}}"
                                                             alt="{{$message->user->name}}">
                                                    </div>
                                                </div>
                                                <div class="chat-content">
                                                    <div class="chat-bubbles">
                                                        <div class="chat-bubble">
                                                            <div class="chat-msg"> {{$message->message}}</div>
                                                        </div>
                                                    </div>
                                                    <ul class="chat-meta">
                                                        <li>{{$message->user->name}}</li>
                                                        <li>{{$message->created_at}}</li>
                                                    </ul>
                                                </div>
                                            </div>
                                        @endif
                                    @empty
                                    @endforelse
                                </div>
                                <form action="/send_message/{{$group->id}}" method="post" v-on:submit='send_message'>
                                    @csrf
                                <div class="nk-chat-editor">
                                        <div class="nk-chat-editor-form">
                                            <div class="form-control-wrap">
                                                <textarea
                                                    name="message" id="message" v-model="message"
                                                    class="form-control form-control-simple no-resize @error('message') is-invalid @enderror" rows="1"
                                                    placeholder="Type your message..."></textarea>
                                            </div>
                                        </div>
                                        <ul class="nk-chat-editor-tools g-2">
                                            <li>
                                                <button type="submit" class="btn btn-round btn-primary btn-icon"><em
                                                        class="icon ni ni-send-alt"></em></button>
                                            </li>
                                        </ul>
                                </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="{{asset('assets/admins/js/bundle41fe.js')}}"></script>
<script src="{{asset('assets/admins/js/scripts41fe.js')}}"></script>
<script src="{{asset('assets/admins/js/demo-settings41fe.js')}}"></script>
<script src="{{asset('assets/admins/js/apps/chats41fe.js')}}"></script>
</body>
</html>
