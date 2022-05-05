<?php
declare(strict_types=1);

namespace App\Providers;

use App\Interfaces\AcademicYearRepositoryInterface;
use App\Interfaces\CampusRepositoryInterface;
use App\Interfaces\DepartmentRepositoryInterface;
use App\Interfaces\PersonnelRepositoryInterface;
use App\Interfaces\ProfessorRepositoryInterface;
use App\Interfaces\TrashedPersonnelRepositoryInterface;
use App\Repositories\Backend\AcademicYearRepository;
use App\Repositories\Backend\CampusRepository;
use App\Repositories\Backend\DepartmentRepository;
use App\Repositories\Backend\PersonnelRepository;
use App\Repositories\Backend\ProfessorRepository;
use App\Repositories\Backend\TrashedPersonnelRepositoryTrashed;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    protected array $repositories = [
        PersonnelRepositoryInterface::class => PersonnelRepository::class,
        AcademicYearRepositoryInterface::class => AcademicYearRepository::class,
        ProfessorRepositoryInterface::class => ProfessorRepository::class,
        CampusRepositoryInterface::class => CampusRepository::class,
        DepartmentRepositoryInterface::class => DepartmentRepository::class,
        TrashedPersonnelRepositoryInterface::class => TrashedPersonnelRepositoryTrashed::class
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
