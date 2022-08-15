<?php

declare(strict_types=1);

namespace App\Contracts;

interface InterroRepositoryInterface
{
    public function interros();

    public function showInterro(string $key);

    public function stored($attributes);

    public function updated(string $key, $attributes);

    public function deleted(string $key);
}
