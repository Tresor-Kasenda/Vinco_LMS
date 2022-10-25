<?php

declare(strict_types=1);

namespace App\Http\Controllers\Backend\Campus;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Campus\StatusCampusRequest;
use App\Repositories\Backend\Campus\CampusStatusRepository;
use Illuminate\Http\JsonResponse;

class StatusCampusBackendController extends Controller
{
    public function __invoke(
        StatusCampusRequest $request,
        CampusStatusRepository $repository
    ): JsonResponse {
        $campus = $repository->handle($request);

        return response()->json([
            'success' => 'Action executez avec success',
            'campus' => $campus,
        ]);
    }
}
