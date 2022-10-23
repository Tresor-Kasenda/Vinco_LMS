<?php

declare(strict_types=1);

namespace App\ViewModels\Backend\Admin;

use App\Http\Controllers\Backend\PersonnelBackendController;
use App\Models\AcademicYear;
use Illuminate\Database\Eloquent\Collection;
use LaravelIdea\Helper\App\Models\_IH_AcademicYear_C;
use Spatie\Permission\Models\Role;
use Spatie\ViewModels\ViewModel;

final class PersonnelViewModel extends ViewModel
{
    public string $indexUrl;

    public function __construct()
    {
        $this->indexUrl = action([PersonnelBackendController::class, 'index']);
    }

    public function roles(): Collection|array
    {
        return Role::query()
            ->whereNotIn('name', ['Super Admin', 'Admin', 'Etudiant', 'Parent', 'Professeur', 'Comptable'])
            ->get();
    }

    public function institutions(): array|Collection|\Illuminate\Support\Collection
    {

        return \App\Models\Institution::select(['id', 'institution_name'])->get();
    }

    public function academics(): array|Collection|_IH_AcademicYear_C
    {
        return AcademicYear::get();
    }
}
