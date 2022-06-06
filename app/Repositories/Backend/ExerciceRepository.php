<?php

declare(strict_types=1);

namespace App\Repositories\Backend;

use App\Models\Exercice;
use Illuminate\Database\Eloquent\Collection;

class ExerciceRepository implements \App\Contracts\ExerciceRepositoryInterface
{

    public function exercises(): array|Collection|\Illuminate\Support\Collection
    {
        return Exercice::query()
            ->with(['course.name,id', 'chapter.name,id', 'lesson.name,id'])
            ->orderByDesc('created_at')
            ->get();
    }

    public function showExercise(string $key)
    {
        // TODO: Implement showResource() method.
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
