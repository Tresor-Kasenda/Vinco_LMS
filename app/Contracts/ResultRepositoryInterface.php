<?php

declare(strict_types=1);

namespace App\Contracts;

interface ResultRepositoryInterface
{
    public function results();

    public function showResult(string $key);

    public function stored($attributes);

    public function updated(string $key, $attributes);

    public function deleted(string $key);
}
