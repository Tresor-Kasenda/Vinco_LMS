<?php

declare(strict_types=1);

namespace App\Http\Controllers\Backend\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\InstitutionApiRequest;
use App\Repositories\Api\PromotionFeeApiRepository;
use Illuminate\Http\JsonResponse;

class PromotionFeeApiController extends Controller
{
    public function getPromotions(
        InstitutionApiRequest $apiRequest,
        PromotionFeeApiRepository $repository
    ): JsonResponse {
        $promotions = $repository->getPromotions($apiRequest);

        return response()->json([
            'promotions' => $promotions,
            'status' => 'success',
        ], 200);
    }
}
