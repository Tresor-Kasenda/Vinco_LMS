<?php

declare(strict_types=1);

use App\Http\Controllers\Backend\Api\ChapterApiController;
use App\Http\Controllers\Backend\Api\ExerciceBackendApiController;
use App\Http\Controllers\Backend\Api\FiliaireApiController;
use App\Http\Controllers\Backend\Api\LessonApiController;
use App\Http\Controllers\Backend\Api\ProfessorApiController;
use App\Http\Controllers\Backend\Api\PromotionApiController;
use App\Http\Controllers\Backend\Api\PromotionFeeApiController;
use App\Http\Controllers\Backend\CampusBackendController;
use App\Http\Controllers\Backend\CategoryBackendController;
use App\Http\Controllers\Backend\ChapterBackendController;
use App\Http\Controllers\Backend\Communication\CalendarBackendController;
use App\Http\Controllers\Backend\Communication\Chat\GroupController;
use App\Http\Controllers\Backend\Communication\Chat\MessageController;
use App\Http\Controllers\Backend\Communication\EventsBackendController;
use App\Http\Controllers\Backend\Communication\JournalBackendController;
use App\Http\Controllers\Backend\Communication\MessageBackendController;
use App\Http\Controllers\Backend\Communication\NotificationBackendController;
use App\Http\Controllers\Backend\CourseBackendController;
use App\Http\Controllers\Backend\DepartmentBackendController;
use App\Http\Controllers\Backend\EnableX\EnableBackendController;
use App\Http\Controllers\Backend\ExamListBackendController;
use App\Http\Controllers\Backend\ExamSessionController;
use App\Http\Controllers\Backend\ExerciseBackendController;
use App\Http\Controllers\Backend\ExpenseBackendController;
use App\Http\Controllers\Backend\ExpenseTypeBackendController;
use App\Http\Controllers\Backend\FeesBackendController;
use App\Http\Controllers\Backend\FeesTypeBackendController;
use App\Http\Controllers\Backend\FiliaireBackendController;
use App\Http\Controllers\Backend\HomeBackendController;
use App\Http\Controllers\Backend\HomeworkBackendController;
use App\Http\Controllers\Backend\InterroBackendController;
use App\Http\Controllers\Backend\LessonBackendController;
use App\Http\Controllers\Backend\ParentBackendController;
use App\Http\Controllers\Backend\PersonnelBackendController;
use App\Http\Controllers\Backend\ProfessorBackendController;
use App\Http\Controllers\Backend\ProfileBackendController;
use App\Http\Controllers\Backend\PromotionBackendController;
use App\Http\Controllers\Backend\ResourceBackendController;
use App\Http\Controllers\Backend\ResultBackendController;
use App\Http\Controllers\Backend\SchedulerBackendController;
use App\Http\Controllers\Backend\SessionBackendController;
use App\Http\Controllers\Backend\SettingsBackendController;
use App\Http\Controllers\Backend\StudentBackendController;
use App\Http\Controllers\Backend\System\InstitutionController;
use App\Http\Controllers\Backend\System\RoleBackendController;
use App\Http\Controllers\Backend\TrashedCampusBackendController;
use App\Http\Controllers\Backend\TrashedCategoryBackendController;
use App\Http\Controllers\Backend\TrashedChapterBackendController;
use App\Http\Controllers\Backend\TrashedCourseBackendController;
use App\Http\Controllers\Backend\TrashedDepartmentBackendController;
use App\Http\Controllers\Backend\TrashedLessonBackendController;
use App\Http\Controllers\Backend\TrashedPersonnelBackendController;
use App\Http\Controllers\Backend\TrashedProfessorBackendController;
use App\Http\Controllers\Backend\TrashedUsersBackendController;
use App\Http\Controllers\Backend\UsersBackendController;
use App\Http\Controllers\Frontend\AboutAppController;
use App\Http\Controllers\Frontend\CalendarAppController;
use App\Http\Controllers\Frontend\EventAppController;
use App\Http\Controllers\Frontend\FeesAppController;
use App\Http\Controllers\Frontend\HomeFrontendController;
use App\Http\Controllers\Frontend\LibraryAppController;
use App\Http\Controllers\Frontend\ShortCoursesAppController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Auth::routes();

Route::group(['middleware' => ['auth']], function () {
    Route::group([
        'prefix' => 'admins',
        'as' => 'admins.',
    ], routes: function () {
        Route::get('backend', [HomeBackendController::class, 'index'])->name('backend.home');

        Route::resource('institution', InstitutionController::class);

        Route::group(['prefix' => 'users', 'as' => 'users.'], routes: function () {
            Route::resource('admin', UsersBackendController::class);
            Route::resource('student', StudentBackendController::class);
            Route::resource('teacher', ProfessorBackendController::class);
            Route::resource('staffs', PersonnelBackendController::class);
            Route::resource('guardian', ParentBackendController::class);
        });

        Route::group(['prefix' => 'academic', 'as' => 'academic.'], routes: function () {
            Route::resource('session', SessionBackendController::class);
            Route::resource('campus', CampusBackendController::class);
            Route::resource('departments', DepartmentBackendController::class);
            Route::resource('promotion', PromotionBackendController::class);
            Route::resource('filiaire', FiliaireBackendController::class);
            Route::resource('categories', CategoryBackendController::class);
            Route::resource('course', CourseBackendController::class);
            Route::resource('chapter', ChapterBackendController::class);
            Route::resource('lessons', LessonBackendController::class);
            Route::resource('resource', ResourceBackendController::class);
            Route::resource('exercice', ExerciseBackendController::class);
            Route::resource('homework', HomeworkBackendController::class);
            Route::resource('interro', InterroBackendController::class);

            Route::get('/getCourse', [ExerciceBackendApiController::class, 'render'])->name('chapter.render');
            Route::get('department-json', [FiliaireApiController::class, 'getFiliaire'])->name('department-json');
            Route::get('promotion-json', [PromotionApiController::class, 'getPromotion'])->name('promotion-json');
            Route::get('professor-json', [ProfessorApiController::class, 'getInstitution'])->name('professor-json');
            Route::get('chapter-json', [ChapterApiController::class, 'getChapters'])->name('chapter-json');
            Route::get('lesson-json', [LessonApiController::class, 'getLesson'])->name('lesson-json');
        });

        Route::group(['prefix' => 'exam', 'as' => 'exam.'], routes: function () {
            Route::resource('session-exams', ExamSessionController::class)->except(['show']);
            Route::resource('exam', ExamListBackendController::class);
            Route::resource('schedule', SchedulerBackendController::class);
            Route::resource('exam-result', ResultBackendController::class);

            Route::put('exam/{key}/active', [ExamListBackendController::class, 'active'])
                ->name('exam.active');
        });

        Route::group(['prefix' => 'announce', 'as' => 'announce.'], routes: function () {
            Route::resource('feesTypes', FeesTypeBackendController::class);
            Route::resource('fees', FeesBackendController::class);
        });

        Route::group(['prefix' => 'communication', 'as' => 'communication.'], routes: function () {
            Route::resource('message', MessageBackendController::class);
            Route::resource('calendar', CalendarBackendController::class);
            Route::resource('events', EventsBackendController::class);
            Route::resource('notification', NotificationBackendController::class);
            Route::resource('journal', JournalBackendController::class);
        });

        Route::group(['prefix' => 'accounting', 'as' => 'accounting.'], routes: function () {
            Route::resource('fees', FeesBackendController::class);
            Route::get('promotion-fee-json', [PromotionFeeApiController::class, 'getPromotions'])->name('promotion-fee-json');
        });

        Route::group(['prefix' => 'rooms', 'as' => 'rooms.'], function () {
            Route::resource('aperi', EnableBackendController::class);
        });

        Route::resource('roles', RoleBackendController::class);
        Route::resource('settings', SettingsBackendController::class);
        Route::put('setting/{system}', [SettingsBackendController::class, 'updateSystem'])->name('system.update');
        Route::controller(ProfileBackendController::class)->group(function () {
            Route::get('profile', 'index')->name('admins.profile');
        });

        Route::controller(TrashedCampusBackendController::class)->group(function () {
            Route::get('historyCampus/', 'index')->name('campus.history');
            Route::put('restoreCampus/{key}', 'restore')->name('campus.restore');
            Route::delete('deleteCampus/{key}', 'destroy')->name('campus.remove');
        });

        Route::controller(TrashedPersonnelBackendController::class)->group(function () {
            Route::get('historyPersonnel/', 'index')->name('personnel.history');
            Route::put('restorePersonnel/{key}', 'restore')->name('personnel.restore');
            Route::delete('deletePersonnel/{key}', 'destroy')->name('personnel.remove');
        });

        Route::controller(TrashedDepartmentBackendController::class)->group(function () {
            Route::get('historyDepartment/', 'index')->name('departments.history');
            Route::put('restoreDepartment/{key}', 'restore')->name('departments.restore');
            Route::delete('deleteDepartment/{key}', 'destroy')->name('departments.remove');
        });

        Route::controller(TrashedProfessorBackendController::class)->group(function () {
            Route::get('historyProfessors/', 'index')->name('teacher.history');
            Route::put('restoreProfessors/{key}', 'restore')->name('teacher.restore');
            Route::delete('deleteProfessors/{key}', 'destroy')->name('teacher.remove');
        });

        Route::controller(TrashedCategoryBackendController::class)->group(function () {
            Route::get('historyCategories/', 'index')->name('categories.history');
            Route::put('restoreCategories/{key}', 'restore')->name('categories.restore');
            Route::delete('deleteCategories/{key}', 'destroy')->name('categories.remove');
        });

        Route::controller(TrashedUsersBackendController::class)->group(function () {
            Route::get('historyUsers/', 'index')->name('administrator.history');
            Route::put('restoreUsers/{key}', 'restore')->name('administrator.restore');
            Route::delete('deleteUsers/{key}', 'destroy')->name('administrator.remove');
        });

        Route::controller(TrashedCourseBackendController::class)->group(function () {
            Route::get('historyCourse/', 'index')->name('course.history');
            Route::put('restoreCourse/{key}', 'restore')->name('course.restore');
            Route::delete('deleteCourse/{key}', 'destroy')->name('course.remove');
        });

        Route::controller(TrashedChapterBackendController::class)->group(function () {
            Route::get('course/{course}/historyChapter', 'index')->name('chapters.history');
            Route::put('course/{course}/restoreChapter/{chapter}', 'restore')->name('chapters.restore');
            Route::delete('course/{course}/deleteChapter/{chapter}', 'destroy')->name('chapters.remove');
        });

        Route::controller(TrashedLessonBackendController::class)->group(callback: function () {
            Route::get('course/{course}/chapter/{chapter}/historyLessons', 'index')->name('lessons.history');
            Route::put('course/{course}/chapter/{chapter}/restoreChapter/{lessons}', 'restore')
                ->name('lessons.restore');
            Route::delete('course/{course}/chapter/{chapter}/deleteChapter/{lessons}', 'destroy')
                ->name('lessons.remove');
        });

        Route::put('activate/{key}/active', [PersonnelBackendController::class, 'active'])->name('personnel.active');
        Route::put('changeStatus/{key}/active', [CampusBackendController::class, 'activate'])->name('campus.active');
        Route::put('activeDepartment/{key}/update', [DepartmentBackendController::class, 'activate'])
            ->name('department.active');
        Route::put('activeProfessor/{key}/update', [ProfessorBackendController::class, 'activate'])
            ->name('teacher.active');
        Route::put('activeCategory/{key}/update', [CategoryBackendController::class, 'activate'])
            ->name('categories.active');
        Route::put('activeUsers/{key}/update', [UsersBackendController::class, 'activate'])
            ->name('administrator.active');
        Route::put('activeCourse/{key}/update', [CourseBackendController::class, 'activate'])->name('course.active');
    });
});

Route::get('/', [HomeFrontendController::class, 'index'])->name('home.index');
Route::get('institutionRegister', [HomeFrontendController::class, 'register'])->name('home.institution.register');
Route::post('institionStore', [HomeFrontendController::class, 'store'])->name('home.institution.store');
Route::get('studentRegister', [HomeFrontendController::class, 'registerStudent'])->name('home.student.register');
Route::post('studentStore', [HomeFrontendController::class, 'storeStudent'])->name('home.student.store');
Route::get('about', [AboutAppController::class, 'index'])->name('about.index');
Route::get('short-courses', [ShortCoursesAppController::class, 'index'])->name('courses.index');
Route::get('calendar', [CalendarAppController::class, 'index'])->name('calendar.index');
Route::get('fees', [FeesAppController::class, 'index'])->name('fees.index');
Route::get('events', [EventAppController::class, 'index'])->name('events.index');
Route::get('library', [LibraryAppController::class, 'index'])->name('library.index');

//Add chat group test
Route::get('/group/create', [GroupController::class, 'create_form']);
Route::post('/group/create', [GroupController::class, 'create']);
Route::get('/group/join', [GroupController::class, 'join_form']);
Route::post('/group/join', [GroupController::class, 'join']);
Route::get('/group/{id}', [GroupController::class, 'show_group']);
Route::get('/group/edit/{id}', [GroupController::class, 'edit']);
Route::post('/group/update/{id}', [GroupController::class, 'update']);
Route::delete('/group/delete/{id}', [GroupController::class, 'delete']);
Route::get('/group/members_list/{id}', [GroupController::class, 'members_list']);
Route::get('/remove_user/{id}/{user_id}', [GroupController::class, 'remove_user']);
Route::post('/send_message/{id}', [MessageController::class, 'send_message']);
Route::get('/show_messages/{id}', [MessageController::class, 'show_messages']);
Route::get('/home-groupe', [App\Http\Controllers\Backend\Communication\Chat\HomeController::class, 'index'])->name('home');
