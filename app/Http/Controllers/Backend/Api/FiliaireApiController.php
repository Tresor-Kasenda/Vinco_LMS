<?php

declare(strict_types=1);

namespace App\Http\Controllers\Backend\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\FiliaireApiRequest;
use App\Repositories\Api\FiliaireApiRepository;
use Illuminate\Http\JsonResponse;

final class FiliaireApiController extends Controller
{
    public function getFiliaire(
        FiliaireApiRequest $apiRequest,
        FiliaireApiRepository $repository
    ): JsonResponse {
        $filiaires = $repository->getFiliaire($apiRequest);

        return response()->json([
            'filiaires' => $filiaires,
            'status' => 'success',
        ], 200);
    }
}
