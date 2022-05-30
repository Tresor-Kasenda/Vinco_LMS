@extends('backend.layout.base')

@section('title', "Administration")

@section('content')
    <div class="container-fluid">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="nk-block">
                    <div class="row g-gs">
                        <div class="col-xxl-6">
                            <div class="row g-gs">
                                <x-statistic
                                    name="Students"
                                    number="{{ \App\Models\Student::all()->count() }}"
                                    route="{{ route('admins.professors.index') }}"
                                />

                                <x-statistic
                                    name="Teachers"
                                    number="{{ \App\Models\Professor::all()->count() }}"
                                    route="{{ route('admins.professors.index') }}"
                                />

                                <x-statistic
                                    name="Stafs"
                                    number="{{ \App\Models\Personnel::all()->count() }}"
                                    route="{{ route('admins.professors.index') }}"
                                />

                                <x-statistic
                                    name="Expense"
                                    number="{{ \App\Models\Course::all()->count() }}"
                                    route="{{ route('admins.professors.index') }}"
                                />

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
