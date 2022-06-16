<?php

declare(strict_types=1);

namespace App\Contracts;

interface FeesRepositoryInterface
{
    public function getFees();

    public function showFee(int $key);

    public function stored($attributes, $factory);

    public function updated(int $key, $attributes, $factory);

    public function deleted(int $key, $factory);
}
