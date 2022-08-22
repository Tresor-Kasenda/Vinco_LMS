<?php

declare(strict_types=1);

namespace App\Contracts;

interface HomeworkRepositoryInterface
{
    public function homeworks();

    public function showHomework(string $key);

    public function stored($attributes);

    public function updated(string $key, $attributes);

    public function deleted(string $key);
}
