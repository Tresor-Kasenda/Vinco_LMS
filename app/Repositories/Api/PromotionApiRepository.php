<?php

declare(strict_types=1);

namespace App\Repositories\Api;

use App\Http\Requests\PromotionApiRequest;
use App\Models\Promotion;
use Illuminate\Database\Eloquent\Collection;
use LaravelIdea\Helper\App\Models\_IH_Promotion_C;

final class PromotionApiRepository
{
    public function getPromotion(PromotionApiRequest $apiRequest): Collection|_IH_Promotion_C|array
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
