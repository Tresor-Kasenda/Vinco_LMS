<?php

declare(strict_types=1);

namespace App\Repositories\Api;

use App\Http\Requests\InstitutionApiRequest;
use App\Models\Campus;
use App\Models\Institution;
use Illuminate\Database\Eloquent\Collection;
use LaravelIdea\Helper\App\Models\_IH_Institution_C;

class InstitutionApiRepository
{
    public function getInstitution(InstitutionApiRequest $apiRequest): _IH_Institution_C|Collection|array
    {
        return Campus::query()
            ->select([
                'id',
                'name',
                'institution_id'
            ])
            ->with('departments:id,name,campus_id')
            ->where('institution_id', '=', $apiRequest->input('institution'))
            ->get();
    }
}
