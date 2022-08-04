<?php

declare(strict_types=1);

namespace App\Repositories\Api;

use App\Http\Requests\ProfessorApiRequest;
use App\Models\Professor;
use Illuminate\Database\Eloquent\Collection;
use LaravelIdea\Helper\App\Models\_IH_Institution_C;

class ProfessorApiRepository
{
    public function getProfessor(ProfessorApiRequest $apiRequest): _IH_Institution_C|Collection|array
    {
        return Professor::query()
            ->select([
                'id',
                'username',
                'lastname',
                'user_id',
            ])
            ->whereHas('user', function ($builder) use ($apiRequest) {
                $builder->where('institution_id', $apiRequest->input('institution'));
            })
            ->get();
    }
}
