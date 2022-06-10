<?php

declare(strict_types=1);

namespace App\Contracts;

interface ExerciseRepositoryInterface
{
    public function exercises();

    public function showExercise(string $key);

    public function stored($attributes, $factory);

    public function updated(string $key, $attributes, $factory);

    public function deleted(string $key, $factory);
}
