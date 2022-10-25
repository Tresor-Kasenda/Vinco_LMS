<?php

declare(strict_types=1);

namespace App\Http\Controllers\Backend\Department;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Department\DepartmentStatusRequest;
use App\Repositories\Backend\Department\DepartmentStatusRepository;
use Illuminate\Http\JsonResponse;

class StatusDepartmentBackendController extends Controller
{
    public function __invoke(
        DepartmentStatusRequest $request,
        DepartmentStatusRepository $repository
    ): JsonResponse {
        $department = $repository->handle($request);

        return response()->json([
            'success' => 'Action executez avec success',
            'department' => $department,
        ]);
    }
}
