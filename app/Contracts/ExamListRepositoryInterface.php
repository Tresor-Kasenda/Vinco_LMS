<?php

declare(strict_types=1);

namespace App\Contracts;

interface ExamListRepositoryInterface
{
    public function exams();

    public function showExam(string $key);

    public function stored($attributes);

    public function updated(string $key, $attributes);

    public function deleted(string $key);
}
