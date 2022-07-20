<?php

declare(strict_types=1);

namespace App\Contracts;

use App\Http\Requests\ActivateExamRequest;

interface ExamListRepositoryInterface
{
    public function exams();

    public function showExam(string $key);

    public function stored($attributes, $factory);

    public function updated(string $key, $attributes, $factory);

    public function deleted(string $key, $factory);

    public function activate(ActivateExamRequest $request);
}
