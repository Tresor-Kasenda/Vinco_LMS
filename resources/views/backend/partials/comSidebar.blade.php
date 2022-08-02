@php
    $role = '';
    $roles = auth()->user()->roles;
    foreach ($roles as $rol){
        $role = $rol;
    }
@endphp
<div class="nk-sidebar nk-sidebar-fixed is-light" data-content="sidebarMenu">
    <div class="nk-sidebar-element nk-sidebar-head">
        <div class="nk-sidebar-brand">
            <a href="{{ route('admins.backend.home') }}" class="logo-link nk-sidebar-logo">
                @if($role->name == 'Super Admin')
                    <img
                        class="logo-light logo-img h-100 w-100"
                        src="{{ asset('assets/favicon.svg') }}"
                        srcset="{{ asset('assets/favicon.svg') }} 3x"
                        alt="logo">
                    <img
                        class="logo-dark logo-img h-100 w-100"
                        src="{{ asset('assets/favicon.svg') }}"
                        srcset="{{ asset('assets/favicon.svg') }} 3x"
                        alt="logo-dark">
                    <img
                        class="logo-small logo-img h-100 w-100"
                        src="{{ asset('assets/favicon.svg') }}"
                        srcset="{{ asset('assets/favicon.svg') }} 3x"
                        alt="logo-small">
                @else
                    <img
                        class="logo-light logo-img h-100 w-100"
                        src="{{ asset('storage/'.auth()->user()->institution->institution_images) }}"
                        srcset="{{ asset('storage/'.auth()->user()->institution->institution_images) }} 3x"
                        alt="logo">
                    <img
                        class="logo-dark logo-img h-100 w-100"
                        src="{{ asset('storage/'.auth()->user()->institution->institution_images) }}"
                        srcset="{{ asset('storage/'.auth()->user()->institution->institution_images) }} 3x"
                        alt="logo-dark">
                    <img
                        class="logo-small logo-img h-100 w-100"
                        src="{{ asset('storage/'.auth()->user()->institution->institution_images) }}"
                        srcset="{{ asset('storage/'.auth()->user()->institution->institution_images) }} 3x"
                        alt="logo-small">
                @endif
            </a>
        </div>
        <div class="nk-menu-trigger me-n2">
            <a href="#" class="nk-nav-toggle nk-quick-nav-icon d-xl-none" data-target="sidebarMenu">
                <em class="icon ni ni-arrow-left"></em>
            </a>
            <a href="#" class="nk-nav-compact nk-quick-nav-icon d-none d-xl-inline-flex" data-target="sidebarMenu">
                <em class="icon ni ni-menu"></em>
            </a>
        </div>
    </div>
    <div class="nk-sidebar-element">
        <div class="nk-sidebar-content">
            <div class="nk-sidebar-menu" data-simplebar>
                <ul class="nk-menu">
                    @role('Student')
                        @include('backend.components._link', [
                            'route' => route('admins.rooms.aperi.index'),
                            'name' => "Aperi",
                            'icon' => "ni-video"
                        ])
                        @include('backend.components._link', [
                            'route' => url('/chatify'),
                            'name' => "Chat",
                            'icon' => "ni-send"
                        ])
                        @include('backend.components._link', [
                            'route' => route('admins.academic.resource.index'),
                            'name' => "Resource",
                            'icon' => "ni-bookmark"
                        ])
                        @include('backend.components._link', [
                            'route' => route('admins.communication.events.index'),
                            'name' => "Events",
                            'icon' => "ni-book"
                        ])
                        @include('backend.components._link', [
                            'route' => route('admins.communication.notification.index'),
                            'name' => "Notification",
                            'icon' => "ni-alert"
                        ])
                        @include('backend.components._link', [
                            'route' => route('admins.communication.journal.index'),
                            'name' => "Journal de classe",
                            'icon' => "ni-bag"
                        ])
                    @endrole

                    @role('Super Admin')
                        @include('backend.components._link', [
                            'route' => route('admins.rooms.aperi.index'),
                            'name' => "Aperi",
                            'icon' => "ni-video"
                        ])
                        @include('backend.components._link', [
                            'route' => url('/chatify'),
                            'name' => "Chat",
                            'icon' => "ni-send"
                        ])
                        @include('backend.components._link', [
                            'route' => route('admins.communication.calendar.index'),
                            'name' => "Calendrier Academique",
                            'icon' => "ni-calendar"
                        ])
                        @include('backend.components._link', [
                            'route' => route('admins.communication.events.index'),
                            'name' => "Events",
                            'icon' => "ni-book"
                        ])
                        @include('backend.components._link', [
                            'route' => route('admins.communication.notification.index'),
                            'name' => "Notification",
                            'icon' => "ni-alert"
                        ])
                        @include('backend.components._link', [
                            'route' => route('admins.communication.journal.index'),
                            'name' => "Journal de classe",
                            'icon' => "ni-bag"
                        ])
                        @include('backend.components._link', [
                            'route' => route('admins.academic.resource.index'),
                            'name' => "Resource",
                            'icon' => "ni-bookmark"
                        ])
                        <li class="nk-menu-item has-sub">
                            <a href="#" class="nk-menu-link nk-menu-toggle">
                                <span class="nk-menu-icon">
                                    <em class="icon ni ni-book-read"></em>
                                </span>
                                <span class="nk-menu-text">Travaux</span>
                            </a>
                            <ul class="nk-menu-sub">
                                @include('backend.components._links', [
                                    'route' => route('admins.academic.exercice.index'),
                                    'name' => "Exercice"
                                ])
                                @include('backend.components._links', [
                                    'route' => route('admins.academic.homework.index'),
                                    'name' => "Homework"
                                ])
                                @include('backend.components._links', [
                                    'route' => route('admins.academic.interro.index'),
                                    'name' => "Interro"
                                ])
                                @include('backend.components._links', [
                                    'route' => route('admins.academic.interro.index'),
                                    'name' => "Bulletin"
                                ])
                            </ul>
                        </li>
                        <li class="nk-menu-item has-sub">
                            <a href="#" class="nk-menu-link nk-menu-toggle">
                                <span class="nk-menu-icon">
                                    <em class="icon ni ni-book-read"></em>
                                </span>
                                <span class="nk-menu-text">Résultats</span>
                            </a>
                            <ul class="nk-menu-sub">
                                @include('backend.components._links', [
                                    'route' => route('admins.academic.exercice.index'),
                                    'name' => "Exercice"
                                ])
                                @include('backend.components._links', [
                                    'route' => route('admins.academic.homework.index'),
                                    'name' => "Homework"
                                ])
                                @include('backend.components._links', [
                                    'route' => route('admins.academic.interro.index'),
                                    'name' => "Interro"
                                ])
                                @include('backend.components._links', [
                                    'route' => route('admins.academic.interro.index'),
                                    'name' => "Bulletin"
                                ])
                            </ul>
                        </li>
                    @endrole

                    @role('Gestionnaire')
                        @include('backend.components._link', [
                            'route' => route('admins.rooms.aperi.index'),
                            'name' => "Aperi",
                            'icon' => "ni-video"
                        ])
                        @include('backend.components._link', [
                            'route' => url('/chatify'),
                            'name' => "Chat",
                            'icon' => "ni-send"
                        ])
                        @include('backend.components._link', [
                            'route' => route('admins.communication.calendar.index'),
                            'name' => "Calendrier Academique",
                            'icon' => "ni-calendar"
                        ])
                        @include('backend.components._link', [
                            'route' => route('admins.communication.events.index'),
                            'name' => "Events",
                            'icon' => "ni-book"
                        ])
                        @include('backend.components._link', [
                            'route' => route('admins.communication.notification.index'),
                            'name' => "Notification",
                            'icon' => "ni-alert"
                        ])
                        @include('backend.components._link', [
                            'route' => route('admins.communication.journal.index'),
                            'name' => "Journal de classe",
                            'icon' => "ni-bag"
                        ])
                        @include('backend.components._link', [
                            'route' => route('admins.academic.resource.index'),
                            'name' => "Resource",
                            'icon' => "ni-bookmark"
                        ])
                        <li class="nk-menu-item has-sub">
                            <a href="#" class="nk-menu-link nk-menu-toggle">
                                    <span class="nk-menu-icon">
                                        <em class="icon ni ni-book-read"></em>
                                    </span>
                                <span class="nk-menu-text">Travaux</span>
                            </a>
                            <ul class="nk-menu-sub">
                                @include('backend.components._links', [
                                    'route' => route('admins.academic.exercice.index'),
                                    'name' => "Exercice"
                                ])
                                @include('backend.components._links', [
                                    'route' => route('admins.academic.homework.index'),
                                    'name' => "Homework"
                                ])
                                @include('backend.components._links', [
                                    'route' => route('admins.academic.interro.index'),
                                    'name' => "Interro"
                                ])
                                @include('backend.components._links', [
                                    'route' => route('admins.academic.interro.index'),
                                    'name' => "Bulletin"
                                ])
                            </ul>
                        </li>
                        <li class="nk-menu-item has-sub">
                            <a href="#" class="nk-menu-link nk-menu-toggle">
                                    <span class="nk-menu-icon">
                                        <em class="icon ni ni-book-read"></em>
                                    </span>
                                <span class="nk-menu-text">Résultats</span>
                            </a>
                            <ul class="nk-menu-sub">
                                @include('backend.components._links', [
                                    'route' => route('admins.academic.exercice.index'),
                                    'name' => "Exercice"
                                ])
                                @include('backend.components._links', [
                                    'route' => route('admins.academic.homework.index'),
                                    'name' => "Homework"
                                ])
                                @include('backend.components._links', [
                                    'route' => route('admins.academic.interro.index'),
                                    'name' => "Interro"
                                ])
                                @include('backend.components._links', [
                                    'route' => route('admins.academic.interro.index'),
                                    'name' => "Bulletin"
                                ])
                            </ul>
                        </li>
                    @endrole

                    @role('Admin')
                        @include('backend.components._link', [
                            'route' => route('admins.rooms.aperi.index'),
                            'name' => "Aperi",
                            'icon' => "ni-video"
                        ])
                        @include('backend.components._link', [
                            'route' => url('/chatify'),
                            'name' => "Chat",
                            'icon' => "ni-send"
                    ])
                        @include('backend.components._link', [
                            'route' => route('admins.communication.calendar.index'),
                            'name' => "Calendrier Academique",
                            'icon' => "ni-calendar"
                        ])
                        @include('backend.components._link', [
                            'route' => route('admins.communication.events.index'),
                            'name' => "Events",
                            'icon' => "ni-book"
                        ])
                        @include('backend.components._link', [
                            'route' => route('admins.communication.notification.index'),
                            'name' => "Notification",
                            'icon' => "ni-alert"
                        ])
                        @include('backend.components._link', [
                            'route' => route('admins.communication.journal.index'),
                            'name' => "Journal de classe",
                            'icon' => "ni-bag"
                        ])
                        @include('backend.components._link', [
                            'route' => route('admins.academic.resource.index'),
                            'name' => "Resource",
                            'icon' => "ni-bookmark"
                    ])
                        <li class="nk-menu-item has-sub">
                            <a href="#" class="nk-menu-link nk-menu-toggle">
                                <span class="nk-menu-icon">
                                    <em class="icon ni ni-book-read"></em>
                                </span>
                                <span class="nk-menu-text">Travaux</span>
                            </a>
                            <ul class="nk-menu-sub">
                                @include('backend.components._links', [
                                    'route' => route('admins.academic.exercice.index'),
                                    'name' => "Exercice"
                                ])
                                @include('backend.components._links', [
                                    'route' => route('admins.academic.homework.index'),
                                    'name' => "Homework"
                                ])
                                @include('backend.components._links', [
                                    'route' => route('admins.academic.interro.index'),
                                    'name' => "Interro"
                                ])
                                @include('backend.components._links', [
                                    'route' => route('admins.academic.interro.index'),
                                    'name' => "Bulletin"
                                ])
                            </ul>
                        </li>
                        <li class="nk-menu-item has-sub">
                            <a href="#" class="nk-menu-link nk-menu-toggle">
                                    <span class="nk-menu-icon">
                                        <em class="icon ni ni-book-read"></em>
                                    </span>
                                <span class="nk-menu-text">Résultats</span>
                            </a>
                            <ul class="nk-menu-sub">
                                @include('backend.components._links', [
                                    'route' => route('admins.academic.exercice.index'),
                                    'name' => "Exercice"
                                ])
                                @include('backend.components._links', [
                                    'route' => route('admins.academic.homework.index'),
                                    'name' => "Homework"
                                ])
                                @include('backend.components._links', [
                                    'route' => route('admins.academic.interro.index'),
                                    'name' => "Interro"
                                ])
                                @include('backend.components._links', [
                                    'route' => route('admins.academic.interro.index'),
                                    'name' => "Bulletin"
                                ])
                            </ul>
                        </li>
                        @include('backend.components._link', [
                            'route' => route('admins.exam.exam.index'),
                            'name' => "Aperi",
                            'icon' => "ni-building"
                        ])
                    @endrole
                    @include('backend.components._link', [
                        'route' => route('admins.backend.home'),
                        'name' => "Go To LMS",
                        'icon' => "ni-home-alt"
                    ])
                    <li class="nk-menu-item">
                        <a class="nk-menu-link" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <span class="nk-menu-icon">
                                <em class="icon ni ni-signout"></em>
                            </span>
                            <span class="nk-menu-text">Logout</span>
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
