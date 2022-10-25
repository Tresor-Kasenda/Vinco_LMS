<?php

declare(strict_types=1);

namespace App\Contracts;

interface ExamSessionRepositoryInterface
{
    public function getExamSessions();

    public function showExamSession(string $key);

    public function stored($attributes);

    public function updated(string $key, $attributes);

    public function deleted(string $key);
}
