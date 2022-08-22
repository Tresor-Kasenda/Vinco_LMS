<?php

declare(strict_types=1);

namespace App\Providers;

use App\Contracts\AcademicYearRepositoryInterface;
use App\Contracts\CampusRepositoryInterface;
use App\Contracts\CategoryRepositoryInterface;
use App\Contracts\ChapterRepositoryInterface;
use App\Contracts\ChartRepositoryInterface;
use App\Contracts\CourseRepositoryInterface;
use App\Contracts\DepartmentRepositoryInterface;
use App\Contracts\EnableX\EnableXRepositoryInterface;
use App\Contracts\EventRepositoryInterface;
use App\Contracts\ExamListRepositoryInterface;
use App\Contracts\ExamSessionRepositoryInterface;
use App\Contracts\ExerciseRepositoryInterface;
use App\Contracts\ExpenseRepositoryInterface;
use App\Contracts\ExpenseTypeRepositoryInterface;
use App\Contracts\FeesRepositoryInterface;
use App\Contracts\FeesTypeRepositoryInterface;
use App\Contracts\FiliaireRepositoryInterface;
use App\Contracts\HomeworkRepositoryInterface;
use App\Contracts\InstitutionRepositoryInterface;
use App\Contracts\InterroRepositoryInterface;
use App\Contracts\JournalRepositoryInterface;
use App\Contracts\LessonRepositoryInterface;
use App\Contracts\NotificationRepositoryInterface;
use App\Contracts\ParentRepositoryInterface;
use App\Contracts\PersonnelRepositoryInterface;
use App\Contracts\ProfessorRepositoryInterface;
use App\Contracts\ProfileRepositoryInterface;
use App\Contracts\PromotionRepositoryInterface;
use App\Contracts\ResourceRepositoryInterface;
use App\Contracts\ResultRepositoryInterface;
use App\Contracts\RoleRepositoryInterface;
use App\Contracts\SchedulerRepositoryInterface;
use App\Contracts\SettingRepositoryInterface;
use App\Contracts\StudentRepositoryInterface;
use App\Contracts\TrashedCampusRepositoryInterface;
use App\Contracts\TrashedCategoryRepositoryInterface;
use App\Contracts\TrashedChapterRepositoryInterface;
use App\Contracts\TrashedCourseRepositoryInterface;
use App\Contracts\TrashedDepartmentRepositoryInterface;
use App\Contracts\TrashedLessonRepositoryInterface;
use App\Contracts\TrashedPersonnelRepositoryInterface;
use App\Contracts\TrashedProfessorRepositoryInterface;
use App\Contracts\TrashedUsersRepositoryInterface;
use App\Contracts\UsersRepositoryInterface;
use App\Repositories\Backend\CampusRepository;
use App\Repositories\Backend\CategoryRepository;
use App\Repositories\Backend\ChapterRepository;
use App\Repositories\Backend\CourseRepository;
use App\Repositories\Backend\DepartmentRepository;
use App\Repositories\Backend\ExamListRepository;
use App\Repositories\Backend\ExamSessionRepository;
use App\Repositories\Backend\ExerciseRepository;
use App\Repositories\Backend\ExpenseRepository;
use App\Repositories\Backend\ExpenseTypeRepository;
use App\Repositories\Backend\FeesRepository;
use App\Repositories\Backend\FeesTypeRepository;
use App\Repositories\Backend\FiliaireRepository;
use App\Repositories\Backend\HomeworkRepository;
use App\Repositories\Backend\InterroRepository;
use App\Repositories\Backend\LessonRepository;
use App\Repositories\Backend\ParentRepository;
use App\Repositories\Backend\PersonnelRepository;
use App\Repositories\Backend\ProfessorRepository;
use App\Repositories\Backend\ProfileRepository;
use App\Repositories\Backend\PromotionRepository;
use App\Repositories\Backend\ResourceRepository;
use App\Repositories\Backend\ResultRepository;
use App\Repositories\Backend\SchedulerRepository;
use App\Repositories\Backend\SessionRepository;
use App\Repositories\Backend\StudentRepository;
use App\Repositories\Backend\TrashedCampusRepository;
use App\Repositories\Backend\TrashedCategoryRepository;
use App\Repositories\Backend\TrashedChapterRepository;
use App\Repositories\Backend\TrashedCourseRepository;
use App\Repositories\Backend\TrashedDepartmentRepository;
use App\Repositories\Backend\TrashedLessonRepository;
use App\Repositories\Backend\TrashedPersonnelRepositoryTrashed;
use App\Repositories\Backend\TrashedProfessorRepository;
use App\Repositories\Backend\TrashedUsersRepository;
use App\Repositories\Backend\UsersRepository;
use App\Repositories\Com\EventRepository;
use App\Repositories\Com\JournalRepository;
use App\Repositories\Com\NotificationRepository;
use App\Repositories\EnableX\EnableBackendRepository;
use App\Repositories\System\ChartRepository;
use App\Repositories\System\InstitutionRepository;
use App\Repositories\System\RoleRepository;
use App\Repositories\System\SettingRepository;
use Illuminate\Support\ServiceProvider;

final class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * @var array|string[]
     */
    protected array $repositories = [
        PersonnelRepositoryInterface::class => PersonnelRepository::class,
        AcademicYearRepositoryInterface::class => SessionRepository::class,
        ProfessorRepositoryInterface::class => ProfessorRepository::class,
        CampusRepositoryInterface::class => CampusRepository::class,
        DepartmentRepositoryInterface::class => DepartmentRepository::class,
        TrashedPersonnelRepositoryInterface::class => TrashedPersonnelRepositoryTrashed::class,
        TrashedDepartmentRepositoryInterface::class => TrashedDepartmentRepository::class,
        TrashedCampusRepositoryInterface::class => TrashedCampusRepository::class,
        TrashedProfessorRepositoryInterface::class => TrashedProfessorRepository::class,
        CategoryRepositoryInterface::class => CategoryRepository::class,
        TrashedCategoryRepositoryInterface::class => TrashedCategoryRepository::class,
        UsersRepositoryInterface::class => UsersRepository::class,
        TrashedUsersRepositoryInterface::class => TrashedUsersRepository::class,
        CourseRepositoryInterface::class => CourseRepository::class,
        TrashedCourseRepositoryInterface::class => TrashedCourseRepository::class,
        ChapterRepositoryInterface::class => ChapterRepository::class,
        TrashedChapterRepositoryInterface::class => TrashedChapterRepository::class,
        LessonRepositoryInterface::class => LessonRepository::class,
        TrashedLessonRepositoryInterface::class => TrashedLessonRepository::class,
        SchedulerRepositoryInterface::class => SchedulerRepository::class,
        PromotionRepositoryInterface::class => PromotionRepository::class,
        FiliaireRepositoryInterface::class => FiliaireRepository::class,
        FeesRepositoryInterface::class => FeesRepository::class,
        ProfileRepositoryInterface::class => ProfileRepository::class,
        ResourceRepositoryInterface::class => ResourceRepository::class,
        ExerciseRepositoryInterface::class => ExerciseRepository::class,
        HomeworkRepositoryInterface::class => HomeworkRepository::class,
        InterroRepositoryInterface::class => InterroRepository::class,
        StudentRepositoryInterface::class => StudentRepository::class,
        ParentRepositoryInterface::class => ParentRepository::class,
        ExamListRepositoryInterface::class => ExamListRepository::class,
        ResultRepositoryInterface::class => ResultRepository::class,
        FeesTypeRepositoryInterface::class => FeesTypeRepository::class,
                SettingRepositoryInterface::class => SettingRepository::class,
        ChartRepositoryInterface::class => ChartRepository::class,
        RoleRepositoryInterface::class => RoleRepository::class,
        EventRepositoryInterface::class => EventRepository::class,
        NotificationRepositoryInterface::class => NotificationRepository::class,
        JournalRepositoryInterface::class => JournalRepository::class,
        InstitutionRepositoryInterface::class => InstitutionRepository::class,
        ExamSessionRepositoryInterface::class => ExamSessionRepository::class,

        //Enable X
        EnableXRepositoryInterface::class => EnableBackendRepository::class,
    ];

    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        foreach ($this->repositories as $interface => $implementation) {
            $this->app->bind($interface, $implementation);
        }
    }
}
