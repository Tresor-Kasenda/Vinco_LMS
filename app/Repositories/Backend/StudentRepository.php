<?php

declare(strict_types=1);

namespace App\Repositories\Backend;

use App\Contracts\StudentRepositoryInterface;
use App\Models\Student;
use App\Traits\ImageUploader;
use Illuminate\Database\Eloquent\Collection;

class StudentRepository implements StudentRepositoryInterface
{
    use ImageUploader;

    public function students(): array|Collection
    {
        return Student::query()
            ->orderByDesc('created_at')
            ->get();
    }

    public function showStudent(string $key)
    {
        // TODO: Implement showStudent() method.
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

    public function changeStatus($attributes)
    {
        // TODO: Implement changeStatus() method.
    }
}
