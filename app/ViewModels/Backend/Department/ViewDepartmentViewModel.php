<?php

declare(strict_types=1);

namespace App\ViewModels\Backend\Department;

use App\Http\Controllers\Backend\Department\DepartmentBackendController;
use App\Models\Department;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use LaravelIdea\Helper\App\Models\_IH_Department_QB;
use Spatie\ViewModels\ViewModel;

class ViewDepartmentViewModel extends ViewModel
{
    public string $indexUrl;
    public string $editUrl;
    public string $deleteUrl;

    public function __construct(public string|int $id)
    {
        $this->indexUrl = action([DepartmentBackendController::class, 'index']);
        $this->editUrl = action([DepartmentBackendController::class, 'edit'], $this->id);
        $this->deleteUrl = action([DepartmentBackendController::class, 'destroy'], $this->id);
    }

    public function department(): Model|Department|Builder|_IH_Department_QB|null
    {
        $department = Department::query()
            ->where('id', '=', $this->id)
            ->first();

        return $department->load(['campus', 'users', 'teachers']);
    }
}
