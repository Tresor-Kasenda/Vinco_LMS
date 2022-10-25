<?php

declare(strict_types=1);

namespace App\ViewModels\Backend\Campus;

use App\Http\Controllers\Backend\Campus\CampusBackendController;
use App\Models\Institution;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use LaravelIdea\Helper\App\Models\_IH_Institution_C;
use LaravelIdea\Helper\App\Models\_IH_User_C;
use Spatie\ViewModels\ViewModel;

class CreateCampusViewModel extends ViewModel
{
    public string $indexUrl;

    public string $storeUrl;

    public function __construct()
    {
        $this->indexUrl = action([CampusBackendController::class, 'index']);
        $this->storeUrl = action([CampusBackendController::class, 'store']);
    }

    public function personnels(): array|Collection|_IH_User_C|\Illuminate\Support\Collection
    {
        if (auth()->user()->hasRole('Super Admin')) {
            return User::query()
                ->select(['id', 'name', 'institution_id'])
                ->with('institution')
                ->whereHas('roles', function ($query) {
                    $query->whereNotIn('name', ['Super Admin', 'Etudiant', 'Parent', 'Comptable']);
                })
                ->get();
        } else {
            return User::query()
                ->select(['id', 'name', 'institution_id'])
                ->with(['institution' => function ($query) {
                    $query->where('id', '=', auth()->user()->institution_id);
                }])
                ->whereHas('roles', function ($query) {
                    $query->whereNotIn('name', ['Super Admin', 'Etudiant', 'Parent', 'Comptable']);
                })
                ->get();
        }
    }

    public function institutions(): _IH_Institution_C|Collection|array
    {
        return Institution::get();
    }
}
