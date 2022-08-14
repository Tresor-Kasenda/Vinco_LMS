<?php

declare(strict_types=1);

namespace App\Http\Controllers\Backend\Api;

use App\Http\Requests\PromotionApiRequest;
use App\Repositories\Api\PromotionApiRepository;
use Illuminate\Http\JsonResponse;

final class PromotionApiController
{
    public function getPromotion(
        PromotionApiRequest $apiRequest,
        PromotionApiRepository $repository
    ): JsonResponse {
        $promotions = $repository->getPromotion($apiRequest);

        return response()->json([
            'promotions' => $promotions,
            'status' => 'success',
        ], 200);
    }
}
