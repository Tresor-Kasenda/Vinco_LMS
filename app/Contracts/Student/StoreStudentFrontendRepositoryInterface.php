<?php

declare(strict_types=1);

namespace App\Contracts\Student;

use App\Http\Requests\Frontend\Student\StoreStudentRequest;

interface StoreStudentFrontendRepositoryInterface
{
    public function store(StoreStudentRequest $request);
}
