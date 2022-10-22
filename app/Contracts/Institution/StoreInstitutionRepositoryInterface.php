<?php

declare(strict_types=1);

namespace App\Contracts\Institution;

use App\Http\Requests\Frontend\Institution\StoreInstitutionRequest;

interface StoreInstitutionRepositoryInterface
{
    public function store(StoreInstitutionRequest $institution);
}
