<?php

declare(strict_types=1);

namespace App\Repositories\Api;

use App\Http\Requests\PromotionApiRequest;
use App\Models\Promotion;
use Illuminate\Database\Eloquent\Collection;

final class PromotionApiRepository
{
    public function getPromotion(PromotionApiRequest $apiRequest): Collection|array
    {
        return Promotion::query()
            ->select([
                'id',
                'name',
                'subsidiary_id',
            ])
            ->where('subsidiary_id', '=', $apiRequest->input('filiaire'))
            ->get();
    }
}
