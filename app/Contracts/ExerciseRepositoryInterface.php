<?php

declare(strict_types=1);

namespace App\Contracts;

interface ExerciseRepositoryInterface
{
    public function exercises();

    public function showExercise(string $key);

    public function stored($attributes);

    public function updated(string $key, $attributes);

    public function deleted(string $key);
}
