<?php

declare(strict_types=1);

namespace App\Contracts;

interface ResultRepositoryInterface
{
    public function results();

    public function showResult(string $key);

    public function stored($attributes, $factory);

    public function updated(string $key, $attributes, $factory);

    public function deleted(string $key, $factory);
}
