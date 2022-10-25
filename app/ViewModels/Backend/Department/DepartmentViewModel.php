<?php

declare(strict_types=1);

namespace App\ViewModels\Backend\Department;

use App\Http\Controllers\Backend\Department\DepartmentBackendController;
use App\Models\Department;
use Spatie\ViewModels\ViewModel;

class DepartmentViewModel extends ViewModel
{
    public string $createUrl;

    public function __construct()
    {
        $this->createUrl = action([DepartmentBackendController::class, 'create']);
    }

    public function departments()
    {
        if (auth()->user()->hasRole('Super Admin')) {
            return Department::query()
                ->select([
                    'id',
                    'name',
                    'campus_id',
                    'images',
                ])
                ->with([
                    'campus:id,name,institution_id',
                    'users',
                    'campus' => [
                        'institution:id,institution_name',
                    ],
                ])
                ->orderByDesc('created_at')
                ->get();
        }

        return Department::query()
            ->select([
                'id',
                'name',
                'campus_id',
                'images',
            ])
            ->with(['campus:id,name'])
            ->whereHas('campus', fn ($query) => $query->where('institution_id', '=', auth()->user()->institution->id))
            ->orderByDesc('created_at')
            ->get();
    }
}
