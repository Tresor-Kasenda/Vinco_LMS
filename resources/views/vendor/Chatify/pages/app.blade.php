@include('Chatify::layouts.headLinks')
<div class="messenger">
    {{-- ----------------------Users/Groups lists side---------------------- --}}
    <div class="messenger-listView">
        {{-- Header and search bar --}}
        <div class="m-header">
            <nav>
                <a href="#"><i class="fas fa-inbox"></i> <span class="messenger-headTitle">MESSAGES</span> </a>
                {{-- header buttons --}}
                <nav class="m-header-right">
                    <a href="#"><i class="fas fa-cog settings-btn"></i></a>
                    <a href="#" class="listView-x"><i class="fas fa-times"></i></a>
                </nav>
            </nav>
            {{-- Search input --}}
            <input type="text" class="messenger-search" placeholder="Search" />
            {{-- Tabs --}}
            <div class="messenger-listView-tabs">
                <a href="#" @if($type == 'user') class="active-tab" @endif data-view="users">
                    <span class="far fa-user"></span> Contacts</a>
                <a href="#" @if($type == 'group') class="active-tab" @endif data-view="groups">
                    <span class="fas fa-users"></span> Groupes</a>
            </div>
        </div>
        {{-- tabs and lists --}}
        <div class="m-body contacts-container">
           {{-- Lists [Users/Group] --}}
           {{-- ---------------- [ User Tab ] ---------------- --}}
           <div class="@if($type == 'user') show @endif messenger-tab users-tab app-scroll" data-view="users">

               {{-- Favorites --}}
               <div class="favorites-section">
                <p class="messenger-title">Favoris</p>
                <div class="messenger-favorites app-scroll-thin"></div>
               </div>

               {{-- Saved Messages --}}
               {!! view('Chatify::layouts.listItem', ['get' => 'saved']) !!}

               {{-- Contact --}}
               <div class="listOfContacts" style="width: 100%;height: calc(100% - 200px);position: relative;"></div>

           </div>

           {{-- ---------------- [ Group Tab ] ---------------- --}}
           <div class="@if($type == 'group') show @endif messenger-tab groups-tab app-scroll" data-view="groups">

               <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">

               <div class="container m-3">
                   <div class="row">
                       <div class="col-md-6">
                           <a class="btn btn-primary"
                              href="/group/create"
                           >Create a group</a>
                       </div>
                       <div class="col-md-6">
                           <a class="btn btn-light" href="/group/join">Join a group</a>
                       </div>
                   </div>
               </div>
               @php
                   $groups = auth()->user()->group_member;
               @endphp
                {{-- items --}}
               @forelse($groups as $group)
                   <table class="table">
                       <tr>
                           <td>
                               <a class="text-black" href="/group/{{$group->id}}">
                                   <p class="text-dark">
                                       {{ strlen($group->name) > 12 ? trim(substr($group->name,0,15)).'..' : $group->name }}</p>

                                   @if ($group->admin_id == auth()->user()->id)
                                       <p class="h6">
                                           Code to join: <em class="text-success">{{$group->code}}</em>
                                       </p>
                                   @endif
                               </a>
                           </td>
                       </tr>
                   </table>
               @empty
               @endforelse
             </div>

             {{-- ---------------- [ Search Tab ] ---------------- --}}
           <div class="messenger-tab search-tab app-scroll" data-view="search">
                {{-- items --}}
                <p class="messenger-title">Recherche</p>
                <div class="search-records">
                    <p class="message-hint center-el"><span>Taper pour rechercher..</span></p>
                </div>
             </div>
        </div>
    </div>

    {{-- ----------------------Messaging side---------------------- --}}
    <div class="messenger-messagingView">
        {{-- header title [conversation name] amd buttons --}}
        <div class="m-header m-header-messaging">
            <nav class="chatify-d-flex chatify-justify-content-between chatify-align-items-center">
                {{-- header back button, avatar and user name --}}
                <div class="chatify-d-flex chatify-justify-content-between chatify-align-items-center">
                    <a href="#" class="show-listView"><i class="fas fa-arrow-left"></i></a>
                    <div class="avatar av-s header-avatar" style="margin: 0px 10px; margin-top: -5px; margin-bottom: -5px;">
                    </div>
                    <a href="#" class="user-name">{{ config('chatify.name') }}</a>
                </div>
                {{-- header buttons --}}
                <nav class="m-header-right">
                    <a href="#" class="add-to-favorite"><i class="fas fa-star"></i></a>
                    <a href="{{route('admins.communication.calendar.index')}}"><i class="fas fa-home"></i></a>
                    <a href="#" class="show-infoSide"><i class="fas fa-info-circle"></i></a>
                </nav>
            </nav>
        </div>
        {{-- Internet connection --}}
        <div class="internet-connection">
            <span class="ic-connected">Connecter</span>
            <span class="ic-connecting">Connexion...</span>
            <span class="ic-noInternet">No internet access</span>
        </div>
        {{-- Messaging area --}}
        <div class="m-body messages-container app-scroll">
            <div class="messages">
                <p class="message-hint center-el"><span>Selectionner ou rechercher une personne pour demarrer une discussion.</span></p>
            </div>
            {{-- Typing indicator --}}
            <div class="typing-indicator">
                <div class="message-card typing">
                    <p>
                        <span class="typing-dots">
                            <span class="dot dot-1"></span>
                            <span class="dot dot-2"></span>
                            <span class="dot dot-3"></span>
                        </span>
                    </p>
                </div>
            </div>
            {{-- Send Message Form --}}
            @include('Chatify::layouts.sendForm')
        </div>
    </div>
    {{-- ---------------------- Info side ---------------------- --}}
    <div class="messenger-infoView app-scroll">
        {{-- nav actions --}}
        <nav>
            <a href="#"><i class="fas fa-times"></i></a>
        </nav>
        {!! view('Chatify::layouts.info')->render() !!}
    </div>
</div>

@include('Chatify::layouts.modals')
@include('Chatify::layouts.footerLinks')
