<?php

declare(strict_types=1);

namespace App\Repositories\Backend;

use App\Contracts\ExerciseRepositoryInterface;
use App\Enums\StatusEnum;
use App\Models\Exercice;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\RedirectResponse;

final class ExerciseRepository implements ExerciseRepositoryInterface
{
    public function exercises(): array|Collection|\Illuminate\Support\Collection
    {
        return Exercice::query()
            ->select([
                'id',
                'name',
                'lesson_id',
                'chapter_id',
                'status',
                'rating',
                'filling_date',
            ])
            ->with(['chapter:id,name', 'lesson:id,name'])
            ->orderByDesc('created_at')
            ->get();
    }

    public function showExercise(string $key): Model|Builder|Exercice
    {
        $exercise = Exercice::query()
            ->select([
                'id',
                'name',
                'lesson_id',
                'chapter_id',
                'course_id',
                'status',
                'rating',
                'filling_date',
            ])
            ->where('id', '=', $key)
            ->first();

        return $exercise->load([
            'course:id,name,images',
            'chapter:id,name',
            'lesson:id,name',
        ]);
    }

    public function stored($attributes, $factory): Model|Builder|Exercice|RedirectResponse
    {
        $lesson = Exercice::query()
            ->create([
                'lesson_id' => $attributes->input('lesson'),
                'chapter_id' => $attributes->input('chapter'),
                'course_id' => $attributes->input('course'),
                'name' => $attributes->input('name'),
                'rating' => $attributes->input('rating'),
                'filling_date' => $attributes->input('date'),
                'status' => StatusEnum::FALSE,
            ]);
        $factory->addSuccess('Une nouvelle resource ajouter a la lecon');

        return $lesson;
    }

    public function updated(string $key, $attributes, $factory): Model|Builder|Exercice
    {
        $lesson = $this->showExercise(key: $key);
        $lesson->update([
            'lesson_id' => $attributes->input('lesson'),
            'chapter_id' => $attributes->input('chapter'),
            'course_id' => $attributes->input('course'),
            'name' => $attributes->input('name'),
            'rating' => $attributes->input('rating'),
            'filling_date' => $attributes->input('date'),
        ]);
        $factory->addSuccess('Une lecon a ete mise a jours avec success');

        return $lesson;
    }

    public function deleted(string $key, $factory): Model|Builder|Exercice
    {
        $lesson = $this->showExercise(key: $key);
        $lesson->delete();
        $factory->addSuccess('La lesson a ete supprimer avec success');

        return $lesson;
    }
}
