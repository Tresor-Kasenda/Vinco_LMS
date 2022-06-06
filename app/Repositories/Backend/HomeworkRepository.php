<?php

declare(strict_types=1);

namespace App\Repositories\Backend;

use App\Contracts\HomeworkRepositoryInterface;
use App\Models\Homework;
use Illuminate\Database\Eloquent\Collection;

class HomeworkRepository implements HomeworkRepositoryInterface
{
    public function homeworks(): array|Collection
    {
        return Homework::query()
            ->orderByDesc('created_at')
            ->get();
    }

    public function showHomework(string $key)
    {
        // TODO: Implement showHomework() method.
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
