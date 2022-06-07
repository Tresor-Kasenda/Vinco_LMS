<div class="nk-sidebar nk-sidebar-fixed is-light" data-content="sidebarMenu">
    <div class="nk-sidebar-element nk-sidebar-head">
        <div class="nk-sidebar-brand">
            <a href="{{ route('admins.backend.home') }}" class="logo-link nk-sidebar-logo">
                <img
                    class="logo-light logo-img"
                    src="{{ asset('assets/vinco-dark.png') }}"
                    srcset="{{ asset('assets/vinco-dark.png') }} 3x"
                    alt="logo">
                <img
                    class="logo-dark logo-img"
                    src="{{ asset('assets/vinco-dark.png') }}"
                    srcset="{{ asset('assets/vinco-dark.png') }} 3x"
                    alt="logo-dark">
                <img
                    class="logo-small logo-img"
                    src="{{ asset('assets/vinco-dark.png') }}"
                    srcset="{{ asset('assets/vinco-dark.png') }} 3x"
                    alt="logo-small">
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

                    @include('backend.components._link', [
                                'route' => route('admins.communication.message.index'),
                                'name' => "Message",
                                'icon' => "ni-send"
                            ])

                    @include('backend.components._link', [
                        'route' => route('admins.communication.calendar.index'),
                        'name' => "Calendar",
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
                        'route' => route('admins.exam.exam.index'),
                        'name' => "Aperi",
                        'icon' => "ni-building"
                    ])

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
