<?php

declare(strict_types=1);

namespace App\Contracts;

interface FeesRepositoryInterface
{
    public function getFees();

    public function showFee(string $key);

    public function stored($attributes, $factory);

    public function updated(string $key, $attributes, $factory);

    public function deleted(string $key, $factory);
}
