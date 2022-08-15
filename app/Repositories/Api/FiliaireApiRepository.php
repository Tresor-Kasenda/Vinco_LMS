<?php

declare(strict_types=1);

namespace App\Repositories\Api;

use App\Http\Requests\FiliaireApiRequest;
use App\Models\Subsidiary;
use Illuminate\Database\Eloquent\Collection;

final class FiliaireApiRepository
{
    public function getFiliaire(FiliaireApiRequest $apiRequest): Collection|array
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
