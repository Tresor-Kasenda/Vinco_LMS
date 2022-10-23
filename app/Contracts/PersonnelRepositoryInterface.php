<?php

declare(strict_types=1);

namespace App\Contracts;

interface PersonnelRepositoryInterface
{
    public function getPersonnelContent();

    public function showPersonnelContent(string $key);

    public function stored($attributes);

    public function updated(string $key, $attributes);

    public function deleted(string $key);
}
