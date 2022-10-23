<?php

declare(strict_types=1);

namespace App\Contracts;

interface AcademicYearRepositoryInterface
{
    public function getAcademicsYears();

    public function stored($attributes);

    public function show(int $academic);

    public function updated(int $academic, $attributes);

    public function deleted(int $academic);
}
