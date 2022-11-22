<?php

declare(strict_types=1);

namespace App\Contracts;

interface EventRepositoryInterface
{
    public function events();

    public function showEvent(string $key);

    public function stored($attributes);

    public function updated(string $key, $attributes);

    public function deleted(string $key);
}
