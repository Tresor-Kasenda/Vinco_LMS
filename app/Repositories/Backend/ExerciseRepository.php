<?php

declare(strict_types=1);

namespace App\Repositories\Backend;

use App\Contracts\ExerciseRepositoryInterface;
use App\Enums\StatusEnum;
use App\Models\Exercice;
use App\Services\ToastMessageService;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\RedirectResponse;

final class ExerciseRepository implements ExerciseRepositoryInterface
{
    public function __construct(protected ToastMessageService $messageService)
    {
    }

    public function exercises(): array|Collection|\Illuminate\Support\Collection
    {
        if (auth()->user()->hasRole('Super Admin')) {
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
            ->whereHas('chapter', function ($query) {
                $query->whereHas('course', function ($query) {
                    $query->where('institution_id', auth()->user()->institution->id);
                });
            })
            ->orderByDesc('created_at')
            ->get();
    }

    public function stored($attributes): Model|Builder|Exercice|RedirectResponse
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
        $this->messageService->success("L'exercice a ete ajouter a une lecon");

        return $lesson;
    }

    public function updated(string $key, $attributes): Model|Builder|Exercice
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
        $this->messageService->success("L'exercice a ete mise a jours avec success");

        return $lesson;
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

    public function deleted(string $key): Model|Builder|Exercice
    {
        $lesson = $this->showExercise(key: $key);
        $lesson->delete();
        $this->messageService->success("L'exercice a ete supprimer avec success");

        return $lesson;
    }
}
