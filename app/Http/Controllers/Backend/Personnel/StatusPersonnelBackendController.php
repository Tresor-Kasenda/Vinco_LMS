<?php

declare(strict_types=1);

namespace App\Http\Controllers\Backend\Personnel;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Personnel\PersonnelStatusRequest;
use App\Repositories\Backend\Personnel\PersonnelStatusRepository;
use Illuminate\Http\JsonResponse;

class StatusPersonnelBackendController extends Controller
{
    public function __invoke(
        PersonnelStatusRequest $request,
        PersonnelStatusRepository $repository
    ): JsonResponse {
        $admin = $repository->handle($request);

        return response()->json([
            'success' => 'Action executez avec success',
            'admin' => $admin
        ]);
    }
}
