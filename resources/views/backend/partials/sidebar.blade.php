<div class="nk-sidebar nk-sidebar-fixed is-light " data-content="sidebarMenu">
    <div class="nk-sidebar-element nk-sidebar-head">
        <div class="nk-sidebar-brand">
            <a href="{{ route('admins.backend.home') }}" class="logo-link nk-sidebar-logo">
                <img
                    class="logo-light logo-img"
                    src="{{ asset('assets/apps/images/VincoWhite/1x/Vinco White Engmdpi.png') }}"
                    srcset="{{ asset('assets/apps/images/VincoWhite/1x/Vinco White Engmdpi.png') }} 3x"
                    alt="logo">
                <img
                    class="logo-dark logo-img"
                    src="{{ asset('assets/apps/images/VincoWhite/1x/Vinco White Engmdpi.png') }}"
                    srcset="{{ asset('assets/apps/images/VincoWhite/1x/Vinco White Engmdpi.png') }} 3x"
                    alt="logo-dark">
                <img
                    class="logo-small logo-img logo-img-small"
                    src="{{ asset('assets/apps/images/VincoWhite/1x/Vinco White Engmdpi.png') }}"
                    srcset="{{ asset('assets/apps/images/VincoWhite/1x/Vinco White Engmdpi.png') }} 3x"
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
                        'route' => route('admins.backend.home'),
                        'name' => "Dashboard",
                        'icon' => "ni-home-alt"
                    ])

                    <li class="nk-menu-item has-sub">
                        <a href="#" class="nk-menu-link nk-menu-toggle">
                            <span class="nk-menu-icon">
                                <em class="icon ni ni-users"></em>
                            </span>
                            <span class="nk-menu-text">Users</span>
                        </a>
                        <ul class="nk-menu-sub">

                            @include('backend.components._links', [
                                'route' => route('admins.administrator.index'),
                                'name' => "Users"
                            ])

                            @include('backend.components._links', [
                                'route' => route('admins.personnel.index'),
                                'name' => "Staffs"
                            ])

                            @include('backend.components._links', [
                                'route' => route('admins.professors.index'),
                                'name' => "Professors"
                            ])
                        </ul>
                    </li>

                    <li class="nk-menu-item has-sub">
                        <a href="#" class="nk-menu-link nk-menu-toggle">
                            <span class="nk-menu-icon">
                                <em class="icon ni ni-book-read"></em>
                            </span>
                            <span class="nk-menu-text">Academic</span>
                        </a>
                        <ul class="nk-menu-sub">

                            @include('backend.components._links', [
                                'route' => route('admins.academic-years.index'),
                                'name' => "Sessions"
                            ])

                            @include('backend.components._links', [
                                'route' => route('admins.campus.index'),
                                'name' => "Campus"
                            ])

                            @include('backend.components._links', [
                                'route' => route('admins.departments.index'),
                                'name' => "Department"
                            ])

                            @include('backend.components._links', [
                                'route' => route('admins.departments.index'),
                                'name' => "Section"
                            ])

                            @include('backend.components._links', [
                                'route' => route('admins.departments.index'),
                                'name' => "Class"
                            ])

                        </ul>
                    </li>

                    @include('backend.components._link', [
                        'route' => route('admins.categories.index'),
                        'name' => "Categories",
                        'icon' => "ni-copy"
                    ])

                    @include('backend.components._link', [
                        'route' => route('admins.course.index'),
                        'name' => "Cours",
                        'icon' => "ni-book-read"
                    ])

                    @include('backend.components._link', [
                        'route' => route('admins.personnel.index'),
                        'name' => "Horaire",
                        'icon' => "ni-calendar-check"
                    ])

                    <li class="nk-menu-heading">
                        <h6 class="overline-title text-primary-alt">Etudiant</h6>
                    </li>

                    @include('backend.components._link', [
                        'route' => route('admins.personnel.index'),
                        'name' => "Students",
                        'icon' => "ni-users"
                    ])

                    @include('backend.components._link', [
                        'route' => route('admins.personnel.index'),
                        'name' => "Etat de compte",
                        'icon' => "ni-coin-alt"
                    ])

                    <li class="nk-menu-heading">
                        <h6 class="overline-title text-primary-alt">Parametre</h6>
                    </li>

                    @include('backend.components._link', [
                        'route' => route('admins.personnel.index'),
                        'name' => "Events",
                        'icon' => "ni-bell"
                    ])

                    @include('backend.components._link', [
                        'route' => route('admins.personnel.index'),
                        'name' => "Notifications",
                        'icon' => "ni-notice"
                    ])

                    @include('backend.components._link', [
                        'route' => route('admins.personnel.index'),
                        'name' => "Parametre",
                        'icon' => "ni-setting-alt"
                    ])

                </ul>
            </div>
        </div>
    </div>
</div>
