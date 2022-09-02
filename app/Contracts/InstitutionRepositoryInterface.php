<?php

declare(strict_types=1);

namespace App\Contracts;

interface InstitutionRepositoryInterface
{
    public function getInstitutions();

    public function showInstitution(string $key);

    public function stored($attributes);

    public function updated(string $key, $attributes);

    public function deleted(string $key);
}
