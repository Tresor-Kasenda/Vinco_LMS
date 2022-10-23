<?php

namespace App\ViewModels\Backend\Admin;

use App\Http\Controllers\Backend\PersonnelBackendController;
use App\Models\AcademicYear;
use App\Models\Personnel;
use Illuminate\Database\Eloquent\Collection;
use LaravelIdea\Helper\App\Models\_IH_AcademicYear_C;
use Spatie\Permission\Models\Role;
use Spatie\ViewModels\ViewModel;

class EditPersonnelViewModel extends ViewModel
{
    public string $indexUrl;

    public string $updateUrl;

    public function __construct(
        public int $personnel
    ) {
        $this->indexUrl = action([PersonnelBackendController::class, 'index']);
        $this->updateUrl = action([PersonnelBackendController::class, 'update'], $this->personnel);
    }

    public function roles(): Collection|array
    {
        return Role::query()
            ->whereNotIn('name', ['Super Admin', 'Admin', 'Etudiant', 'Parent', 'Professeur', 'Comptable'])
            ->get();
    }

    public function personnel(): Personnel
    {
        return Personnel::query()
            ->where('id', '=', $this->personnel)
            ->first();
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
