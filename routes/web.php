<?php

use App\Http\Controllers\App\AboutAppController;
use App\Http\Controllers\App\CalendarAppController;
use App\Http\Controllers\App\EventAppController;
use App\Http\Controllers\App\FeesAppController;
use App\Http\Controllers\App\HomeFrontendController;
use App\Http\Controllers\App\LibraryAppController;
use App\Http\Controllers\App\ShortCoursesAppController;
use App\Http\Controllers\Backend\AcademicYearBackendController;
use App\Http\Controllers\Backend\CampusBackendController;
use App\Http\Controllers\Backend\DepartmentBackendController;
use App\Http\Controllers\Backend\HomeBackendController;
use App\Http\Controllers\Backend\PersonnelBackendController;
use App\Http\Controllers\Backend\ProfessorBackendController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Auth::routes();

Route::group(['middleware' => 'auth'], function (){
    Route::group([
        'prefix' => 'admins',
        'as' => 'admins.',
        'middleware' => ['admins']
    ], function(){
        Route::get('backend', [HomeBackendController::class, 'index'])->name('backend.home');
        Route::resource('personnel', PersonnelBackendController::class);
        Route::resource('professors', ProfessorBackendController::class);
        Route::resource('academic-years', AcademicYearBackendController::class);
        Route::resource('campus', CampusBackendController::class);
        Route::resource('departments', DepartmentBackendController::class);

        Route::put('personnel/{key}/active', [PersonnelBackendController::class, 'active'])->name('personnel.active');
    });
});

Route::get('/', [HomeFrontendController::class, 'index'])->name('home.index');
Route::get('about', [AboutAppController::class, 'index'])->name('about.index');
Route::get('short-courses', [ShortCoursesAppController::class, 'index'])->name('courses.index');
Route::get('calendar', [CalendarAppController::class, 'index'])->name('calendar.index');
Route::get('fees', [FeesAppController::class, 'index'])->name('fees.index');
Route::get('events', [EventAppController::class, 'index'])->name('events.index');
Route::get('library', [LibraryAppController::class, 'index'])->name('library.index');
