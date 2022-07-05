<?php

declare(strict_types=1);

namespace App\Contracts;

interface ParentRepositoryInterface
{
    public function guardians();

    public function showGuardian(string $key);

    public function stored($attributes, $factory);

    public function updated(string $key, $attributes, $factory);

    public function deleted(string $key, $factory);
}
