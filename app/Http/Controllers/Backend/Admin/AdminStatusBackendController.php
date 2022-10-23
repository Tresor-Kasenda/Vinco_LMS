<?php

declare(strict_types=1);

namespace App\Http\Controllers\Backend\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Admins\AdminStatusRequest;
use App\Repositories\Backend\Admins\AdminStatusRepository;
use Illuminate\Http\JsonResponse;

class AdminStatusBackendController extends Controller
{
    public function __invoke(
        AdminStatusRequest $request,
        AdminStatusRepository $repository
    ): JsonResponse {
        $admin = $repository->handle($request);

        return response()->json([
            'success' => 'Action executez avec success',
            'admin' => $admin,
        ]);
    }
}
