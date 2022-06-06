<?php

declare(strict_types=1);

namespace App\Contracts;

interface InterroRepositoryInterface
{
    public function interros();

    public function showInterro(string $key);

    public function stored($attributes, $factory);

    public function updated(string $key, $attributes, $factory);

    public function deleted(string $key, $factory);
}
