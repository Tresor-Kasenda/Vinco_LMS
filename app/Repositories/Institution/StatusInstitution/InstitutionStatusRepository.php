<?php

declare(strict_types=1);

namespace App\Repositories\Institution\StatusInstitution;

use App\Http\Requests\InstitutionStatusRequest;
use App\Models\Institution;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class InstitutionStatusRepository
{
    public function handle(InstitutionStatusRequest $request): Model|Institution|Builder|null
    {
        $institution = Institution::query()
            ->where('id', '=', $request->input('institution'))
            ->first();
        $institution->update(['status' => $request->input('status')]);
        return $institution;
    }
}
