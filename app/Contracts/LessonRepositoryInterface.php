<?php

declare(strict_types=1);

namespace App\Contracts;

interface LessonRepositoryInterface
{
    public function getLessons();

    public function showLesson(string $key);

    public function stored($attributes, $flash);

    public function updated(string $key, $attributes, $flash);

    public function deleted(string $key, $flash);
}
