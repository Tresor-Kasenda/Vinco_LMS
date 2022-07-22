@extends('backend.layout.base')

@section('title', "Tableau de bord")

@section('content')
    <div class="container-fluid">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="nk-block">
                    <div class="row g-gs">
                        <div class="col-xxl-6 col-lg-12">
                            <div class="row g-gs">
                                @role('Parent')
                                    <x-statistic
                                        name="Due Fees"
                                        number="{{ \App\Models\Course::all()->count() }}"
                                        route="{{ route('admins.accounting.fees.index') }}"
                                    />

                                    <x-statistic
                                        name="Events"
                                        number="{{ \App\Models\Course::all()->count() }}"
                                        route="{{ route('admins.accounting.fees.index') }}"
                                    />

                                    <x-statistic
                                        name="Exams"
                                        number="{{ \App\Models\Course::all()->count() }}"
                                        route="{{ route('admins.accounting.fees.index') }}"
                                    />

                                    <x-statistic
                                        name="Cours"
                                        number="{{ \App\Models\Course::all()->count() }}"
                                        route="{{ route('admins.accounting.fees.index') }}"
                                    />
                                @endrole

                                @role('Super Admin')
                                    <x-statistic
                                        name="Institutions"
                                        number="{{ \App\Models\Institution::all()->count() }}"
                                        route="{{ route('admins.institution.index') }}"
                                    />
                                    <x-statistic
                                        name="Etudiants"
                                        number="{{ \App\Models\Student::all()->count() }}"
                                        route="{{ route('admins.users.student.index') }}"
                                    />

                                    <x-statistic
                                        name="Professeurs"
                                        number="{{ \App\Models\Professor::all()->count() }}"
                                        route="{{ route('admins.users.teacher.index') }}"
                                    />

                                    <x-statistic
                                        name="Personnels"
                                        number="{{ \App\Models\Personnel::all()->count() }}"
                                        route="{{ route('admins.users.staffs.index') }}"
                                    />

                                    <x-statistic
                                        name="Parents"
                                        number="{{ \App\Models\Guardian::all()->count() }}"
                                        route="{{ route('admins.users.guardian.index') }}"
                                    />
                                    <x-statistic
                                        name="Depenses"
                                        number="{{ \App\Models\Expense::all()->count() }}"
                                        route="{{ route('admins.accounting.expenses.index') }}"
                                    />
                                    <x-statistic
                                        name="Entree"
                                        number="{{ \App\Models\Fee::all()->count() }}"
                                        route="{{ route('admins.accounting.fees.index') }}"
                                    />
                                    <x-statistic
                                        name="Examens"
                                        number="{{ \App\Models\Exam::all()->count() }}"
                                        route="{{ route('admins.exam.exam.index') }}"
                                    />
                                    <x-statistic
                                        name="Evenements"
                                        number="{{ \App\Models\Event::all()->count() }}"
                                        route="{{ route('admins.exam.exam.index') }}"
                                    />
                                @endrole

                            </div>
                        </div>
                        <div class="col-md-6 col-xxl-4">
                            <div class="card h-100">
                                <div class="card-inner border-bottom">
                                    <div class="card-title-group">
                                        <div class="card-title">
                                            <h6 class="title">Support Requests</h6>
                                        </div>
                                    </div>
                                </div>
                                <ul class="nk-support">
                                    <li class="nk-support-item">
                                        <div class="user-avatar">
                                            <img src="../images/avatar/a-sm.jpg" alt="">
                                        </div>
                                        <div class="nk-support-content">
                                            <div class="title">
                                                <span>Vincent Lopez</span>
                                                <div class="status delivered">
                                                    <em class="icon ni ni-check-circle-fill"></em>
                                                </div>
                                            </div>
                                            <p>Thanks for contact us with your issues...</p>
                                            <span class="time">6 min ago</span>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-md-6 col-xxl-4">
                            <div class="card h-100">
                                <div class="card-inner border-bottom">
                                    <div class="card-title-group">
                                        <div class="card-title">
                                            <h6 class="title">Support Requests</h6>
                                        </div>
                                    </div>
                                </div>
                                <ul class="nk-support">
                                    <li class="nk-support-item">
                                        <div class="user-avatar">
                                            <img src="../images/avatar/a-sm.jpg" alt="">
                                        </div>
                                        <div class="nk-support-content">
                                            <div class="title">
                                                <span>Vincent Lopez</span>
                                                <div class="status delivered">
                                                    <em class="icon ni ni-check-circle-fill"></em>
                                                </div>
                                            </div>
                                            <p>Thanks for contact us with your issues...</p>
                                            <span class="time">6 min ago</span>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
