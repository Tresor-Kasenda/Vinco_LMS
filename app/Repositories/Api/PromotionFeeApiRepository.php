<?php

declare(strict_types=1);

namespace App\Repositories\Api;

use App\Http\Requests\InstitutionApiRequest;
use App\Models\Promotion;
use Illuminate\Database\Eloquent\Collection;

class PromotionFeeApiRepository
{
    public function getPromotions(InstitutionApiRequest $apiRequest): Collection|array
    {
        return Promotion::query()
            ->select(['id', 'name', 'subsidiary_id'])
            ->whereHas('subsidiary', function ($query) use ($apiRequest) {
                $query->whereHas('department', function ($query) use ($apiRequest) {
                    $query->whereHas('campus', function ($query) use ($apiRequest) {
                        $query->where('institution_id', $apiRequest->input('institution'));
                    });
                });
            })
            ->get();
    }
}
