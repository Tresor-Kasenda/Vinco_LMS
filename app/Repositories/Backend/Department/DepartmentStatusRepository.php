<?php

declare(strict_types=1);

namespace App\Repositories\Backend\Department;

use App\Http\Requests\Backend\Department\DepartmentStatusRequest;
use App\Models\Department;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use LaravelIdea\Helper\App\Models\_IH_Department_QB;

class DepartmentStatusRepository
{

    public function handle(DepartmentStatusRequest $request): Model|Department|Builder|_IH_Department_QB|null
    {
        $admin = Department::query()
            ->where('id', '=', $request->input('department'))
            ->first();
        $admin->update(['status' => $request->input('status')]);

        return $admin;
    }
}
