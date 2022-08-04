<?php

declare(strict_types=1);

namespace App\Repositories\Api;

use App\Http\Requests\FiliaireApiRequest;
use App\Models\Subsidiary;
use Illuminate\Database\Eloquent\Collection;
use LaravelIdea\Helper\App\Models\_IH_Subsidiary_C;

class FiliaireApiRepository
{
    public function getFiliaire(FiliaireApiRequest $apiRequest): Collection|array|_IH_Subsidiary_C
    {
        return Subsidiary::query()
            ->select([
                'id',
                'name',
                'department_id',
            ])
            ->where('department_id', '=', $apiRequest->input('department'))
            ->get();
    }
}
