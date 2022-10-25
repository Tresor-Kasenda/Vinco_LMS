<?php

declare(strict_types=1);

namespace App\Http\Controllers\Backend\Guardian;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Parent\ParentStatusRequest;
use App\Repositories\Backend\Guardian\ParentStatusRepository;
use Illuminate\Http\JsonResponse;

class StatusParentBackendController extends Controller
{
    public function __invoke(
        ParentStatusRequest $request,
        ParentStatusRepository $repository
    ): JsonResponse {
        $parent = $repository->handle($request);

        return response()->json([
            'success' => 'Action executez avec success',
            'parent' => $parent,
        ]);
    }
}
