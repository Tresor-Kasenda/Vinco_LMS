<?php

declare(strict_types=1);

namespace App\Contracts;

interface StudentRepositoryInterface
{
    public function students();

    public function showStudent(string $key);

    public function stored($attributes);

    public function updated(string $key, $attributes);

    public function deleted(string $key);

    public function changeStatus($attributes);
}
