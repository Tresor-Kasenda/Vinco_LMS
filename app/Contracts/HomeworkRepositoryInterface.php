<?php

declare(strict_types=1);

namespace App\Contracts;

interface HomeworkRepositoryInterface
{
    public function homeworks();

    public function showHomework(string $key);

    public function stored($attributes, $factory);

    public function updated(string $key, $attributes, $factory);

    public function deleted(string $key, $factory);
}
