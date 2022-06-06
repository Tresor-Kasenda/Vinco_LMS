<?php

declare(strict_types=1);

namespace App\Repositories\Backend;

use App\Contracts\ExamListRepositoryInterface;
use App\Models\Exam;
use Illuminate\Database\Eloquent\Collection;

class ExamListRepository implements ExamListRepositoryInterface
{
    public function exams(): array|Collection
    {
        return Exam::query()
            ->orderByDesc('created_at')
            ->get();
    }

    public function showExam(string $key)
    {
        // TODO: Implement showExam() method.
    }

    public function stored($attributes, $factory)
    {
        // TODO: Implement stored() method.
    }

    public function updated(string $key, $attributes, $factory)
    {
        // TODO: Implement updated() method.
    }

    public function deleted(string $key, $factory)
    {
        // TODO: Implement deleted() method.
    }
}
