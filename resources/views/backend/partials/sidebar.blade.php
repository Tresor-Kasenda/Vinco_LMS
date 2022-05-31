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
                                'route' => route('admins.promotion.index'),
                                'name' => "Promotion"
                            ])

                            @include('backend.components._links', [
                                'route' => route('admins.filiaire.index'),
                                'name' => "Filiaire"
                            ])

                            @include('backend.components._links', [
                                'route' => route('admins.categories.index'),
                                'name' => "Categories"
                            ])

                            @include('backend.components._links', [
                                'route' => route('admins.course.index'),
                                'name' => "Syllabus"
                            ])

                            @include('backend.components._links', [
                                'route' => route('admins.course.index'),
                                'name' => "Lecon"
                            ])

                            @include('backend.components._links', [
                                'route' => route('admins.course.index'),
                                'name' => "Resource"
                            ])

                            @include('backend.components._links', [
                                'route' => route('admins.course.index'),
                                'name' => "Exercice"
                            ])

                            @include('backend.components._links', [
                                'route' => route('admins.course.index'),
                                'name' => "Devoir"
                            ])
                            @include('backend.components._links', [
                                'route' => route('admins.course.index'),
                                'name' => "Interro"
                            ])
                        </ul>
                    </li>

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

                            @include('backend.components._links', [
                                'route' => route('admins.professors.index'),
                                'name' => "Student"
                            ])

                            @include('backend.components._links', [
                                'route' => route('admins.professors.index'),
                                'name' => "Parents"
                            ])
                        </ul>
                    </li>

                    <li class="nk-menu-item has-sub">
                        <a href="#" class="nk-menu-link nk-menu-toggle">
                            <span class="nk-menu-icon">
                                <em class="icon ni ni-edit-alt"></em>
                            </span>
                            <span class="nk-menu-text">Exam</span>
                        </a>
                        <ul class="nk-menu-sub">

                            @include('backend.components._links', [
                                'route' => route('admins.administrator.index'),
                                'name' => "Exam List"
                            ])

                            @include('backend.components._links', [
                                'route' => route('admins.personnel.index'),
                                'name' => "Schedule"
                            ])

                            @include('backend.components._links', [
                                'route' => route('admins.personnel.index'),
                                'name' => "Exam Result"
                            ])
                        </ul>
                    </li>

                    <li class="nk-menu-item has-sub">
                        <a href="#" class="nk-menu-link nk-menu-toggle">
                            <span class="nk-menu-icon">
                                <em class="icon ni ni-bell"></em>
                            </span>
                            <span class="nk-menu-text">Announcement</span>
                        </a>
                        <ul class="nk-menu-sub">

                            @include('backend.components._links', [
                                'route' => route('admins.administrator.index'),
                                'name' => "Message"
                            ])

                            @include('backend.components._links', [
                                'route' => route('admins.personnel.index'),
                                'name' => "Calendar"
                            ])

                            @include('backend.components._links', [
                                'route' => route('admins.personnel.index'),
                                'name' => "Events"
                            ])

                            @include('backend.components._links', [
                                'route' => route('admins.personnel.index'),
                                'name' => "Notification"
                            ])

                        </ul>
                    </li>

                    <li class="nk-menu-item has-sub">
                        <a href="#" class="nk-menu-link nk-menu-toggle">
                            <span class="nk-menu-icon">
                                <em class="icon ni ni-coin-alt"></em>
                            </span>
                            <span class="nk-menu-text">Accounting</span>
                        </a>
                        <ul class="nk-menu-sub">

                            @include('backend.components._links', [
                                'route' => route('admins.administrator.index'),
                                'name' => "Fees"
                            ])

                            @include('backend.components._links', [
                                'route' => route('admins.personnel.index'),
                                'name' => "Expense List"
                            ])

                        </ul>
                    </li>

                    @include('backend.components._link', [
                        'route' => route('admins.personnel.index'),
                        'name' => "Role",
                        'icon' => "ni-lock-alt"
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
