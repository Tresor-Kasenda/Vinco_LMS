<div class="nk-sidebar nk-sidebar-fixed is-light " data-content="sidebarMenu">
    <div class="nk-sidebar-element nk-sidebar-head">
        <div class="nk-sidebar-brand">
            <a href="{{ route('admins.backend.home') }}" class="logo-link nk-sidebar-logo">
                <img class="logo-light logo-img" src="{{ asset('assets/frontend/images/VincoWhite/1x/Vinco color Frenchmdpi.png') }}" srcset="{{ asset('assets/frontend/images/VincoWhite/1x/Vinco color Frenchmdpi.png') }} 3x" alt="logo">
                <img class="logo-dark logo-img" src="{{ asset('assets/frontend/images/VincoWhite/1x/Vinco color Frenchmdpi.png') }}" srcset="{{ asset('assets/frontend/images/VincoWhite/1x/Vinco color Frenchmdpi.png') }} 3x" alt="logo-dark">
                <img class="logo-small logo-img logo-img-small" src="{{ asset('assets/frontend/images/VincoWhite/1x/Vinco color Frenchmdpi.png') }}" srcset="{{ asset('assets/frontend/images/VincoWhite/1x/Vinco color Frenchmdpi.png') }} 3x" alt="logo-small">
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
                        'name' => "Accueil",
                        'icon' => "ni-dashboard-fill"
                    ])
                    <li class="nk-menu-heading">
                        <h6 class="overline-title text-primary-alt">Administrateurs</h6>
                    </li>

                    @include('backend.components._link', [
                        'route' => route('admins.administrator.index'),
                        'name' => "Administrateur",
                        'icon' => "ni-user-alt"
                    ])

                    <li class="nk-menu-heading">
                        <h6 class="overline-title text-primary-alt">Administration</h6>
                    </li>
                    @include('backend.components._link', [
                        'route' => route('admins.academic-years.index'),
                        'name' => "Annee academique",
                        'icon' => "ni-swap"
                    ])
                    @include('backend.components._link', [
                        'route' => route('admins.personnel.index'),
                        'name' => "Personnel",
                        'icon' => "ni-user-c"
                    ])
                    @include('backend.components._link', [
                        'route' => route('admins.campus.index'),
                        'name' => "Campus",
                        'icon' => "ni-book"
                    ])
                    @include('backend.components._link', [
                        'route' => route('admins.departments.index'),
                        'name' => "Departments",
                        'icon' => "ni-layers"
                    ])
                    <li class="nk-menu-heading">
                        <h6 class="overline-title text-primary-alt">Professeurs</h6>
                    </li>
                    @include('backend.components._link', [
                        'route' => route('admins.professors.index'),
                        'name' => "Professors",
                        'icon' => "ni-user-circle"
                    ])
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
