<?php

declare(strict_types=1);

namespace App\ViewModels\Backend\Department;

use App\Http\Controllers\Backend\Department\DepartmentBackendController;
use App\Models\Campus;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use LaravelIdea\Helper\App\Models\_IH_Campus_C;
use LaravelIdea\Helper\App\Models\_IH_User_C;
use Spatie\ViewModels\ViewModel;

class CreateDepartmentViewModel extends ViewModel
{
    public string $indexURL;
    public string $storeURL;

    public function __construct()
    {
        $this->indexURL = action([DepartmentBackendController::class, 'index']);
        $this->storeURL = action([DepartmentBackendController::class, 'store']);
    }

    public function users(): Collection|array|_IH_User_C
    {
        if (auth()->user()->hasRole('Super Admin')){
            return User::query()
                ->whereHas('roles', function ($query){
                    $query->whereNotIn('name', ['Super Admin', 'Admin', 'Etudiant', 'Parent', 'Comptable']);
                })
                ->with(['institution', 'teacher'])
                ->get();
        } else {
            return User::query()
                ->where('institution_id', '=', auth()->user()->institution->id)
                ->with(['teacher', 'institution'])
                ->whereHas('roles', function ($query){
                    $query->whereNotIn('name', ['Super Admin', 'Admin', 'Etudiant', 'Parent', 'Comptable']);
                })
                ->get()
                ->filter(fn($query) => $query->where('status', App\Enums\StatusEnum::TRUE));
        }
    }

    public function campuses(): _IH_Campus_C|Collection|array
    {
        if (auth()->user()->hasRole('Super Admin')){
            return Campus::query()
                ->get();
        }
         return Campus::query()
            ->where('institution_id', '=', auth()->user()->institution->id)->get();
    }
}
