<?php

declare(strict_types=1);

namespace App\Repositories\Backend;

use App\Contracts\ExerciseRepositoryInterface;
use App\Enums\StatusEnum;
use App\Models\Exercice;
use App\Traits\ImageUploader;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\RedirectResponse;

class ExerciseRepository implements ExerciseRepositoryInterface
{
    public function exercises(): array|Collection|\Illuminate\Support\Collection
    {
        return Exercice::query()
            ->with(['course', 'chapter', 'lesson'])
            ->orderByDesc('created_at')
            ->get();
    }

    public function showExercise(string $key): Model|Builder|Exercice
    {
        $exercise = Exercice::query()
            ->where('key', '=', $key)
            ->firstOrCreate();

        return $exercise->load(['course', 'chapter', 'lesson']);
    }

    public function stored($attributes, $factory): Model|Builder|Exercice|RedirectResponse
    {
        $lesson = Exercice::query()
            ->when('name', function ($query) use ($attributes) {
                $query->where('name', $attributes->input('name'));
            })
            ->first();
        if (! $lesson) {
            $lesson = Exercice::query()
                ->create([
                    'lesson_id' => $attributes->input('lesson'),
                    'status' => StatusEnum::TRUE,
                    'chapter_id' => $attributes->input('chapter'),
                    'course_id' => $attributes->input('course'),
                    'name' => $attributes->input('name'),
                    'condition' => $attributes->input('condition'),
                    'weighting' => $attributes->input('weighting'),
                    'date' => $attributes->input('date'),
                    'schedule' => $attributes->input('schedule'),
                    'duration' => $attributes->input('duration'),
                ]);
            $factory->addSuccess('Une nouvelle resource ajouter a la lecon');

            return $lesson;
        }
        $factory->addError('Nom du resource existe deja pour ce chapitre');

        return back();
    }

    public function updated(string $key, $attributes, $factory): Model|Builder|Exercice
    {
        $lesson = $this->showExercise(key: $key);
        $lesson->update([
            'lesson_id' => $attributes->input('lesson'),
            'chapter_id' => $attributes->input('chapter'),
            'course_id' => $attributes->input('course'),
            'name' => $attributes->input('name'),
            'condition' => $attributes->input('condition'),
            'weighting' => $attributes->input('weighting'),
            'date' => $attributes->input('date'),
            'schedule' => $attributes->input('schedule'),
            'duration' => $attributes->input('duration'),
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
