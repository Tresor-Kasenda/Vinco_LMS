<?php

declare(strict_types=1);

namespace App\Providers;

use App\Contracts\AcademicYearRepositoryInterface;
use App\Contracts\CampusRepositoryInterface;
use App\Contracts\CategoryRepositoryInterface;
use App\Contracts\ChapterRepositoryInterface;
use App\Contracts\CourseRepositoryInterface;
use App\Contracts\DepartmentRepositoryInterface;
use App\Contracts\FeesRepositoryInterface;
use App\Contracts\FiliaireRepositoryInterface;
use App\Contracts\LessonRepositoryInterface;
use App\Contracts\PersonnelRepositoryInterface;
use App\Contracts\ProfessorRepositoryInterface;
use App\Contracts\ProfileRepositoryInterface;
use App\Contracts\PromotionRepositoryInterface;
use App\Contracts\SchedulerRepositoryInterface;
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
use App\Repositories\Backend\AcademicYearRepository;
use App\Repositories\Backend\CampusRepository;
use App\Repositories\Backend\CategoryRepository;
use App\Repositories\Backend\ChapterRepository;
use App\Repositories\Backend\CourseRepository;
use App\Repositories\Backend\DepartmentRepository;
use App\Repositories\Backend\FeesRepository;
use App\Repositories\Backend\FiliaireRepository;
use App\Repositories\Backend\LessonRepository;
use App\Repositories\Backend\PersonnelRepository;
use App\Repositories\Backend\ProfessorRepository;
use App\Repositories\Backend\ProfileRepository;
use App\Repositories\Backend\PromotionRepository;
use App\Repositories\Backend\SchedulerRepository;
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
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * @var array|string[]
     */
    protected array $repositories = [
        PersonnelRepositoryInterface::class => PersonnelRepository::class,
        AcademicYearRepositoryInterface::class => AcademicYearRepository::class,
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
    ];

    /**
     * @return void
     */
    public function register(): void
    {
        //
    }

    /**
     * @return void
     */
    public function boot(): void
    {
        foreach ($this->repositories as $interface => $implementation) {
            $this->app->bind($interface, $implementation);
        }
    }
}
