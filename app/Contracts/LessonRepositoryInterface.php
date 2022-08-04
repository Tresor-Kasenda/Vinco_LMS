<?php

declare(strict_types=1);

namespace App\Contracts;

interface LessonRepositoryInterface
{
    public function getLessons();

    public function showLesson(string $key);

    public function stored($attributes);

    public function updated(string $key, $attributes);

    public function deleted(string $key);
}
