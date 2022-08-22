<?php

declare(strict_types=1);

namespace App\Repositories\Backend;

use App\Contracts\InterroRepositoryInterface;
use App\Enums\StatusEnum;
use App\Models\Question;
use App\Services\ToastMessageService;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

final class InterroRepository implements InterroRepositoryInterface
{
    public function __construct(protected ToastMessageService $messageService)
    {
    }

    public function interros(): array|Collection|\Illuminate\Support\Collection
    {
        if (auth()->user()->hasRole('Super Admin')) {
            return Question::query()
                ->select([
                    'id',
                    'rating',
                    'date',
                    'duration',
                    'course_id',
                    'chapter_id',
                ])
                ->with(['course:id,name', 'chapter:id,name'])
                ->orderByDesc('created_at')
                ->get();
        }

        return Question::query()
            ->select([
                'id',
                'rating',
                'date',
                'duration',
                'course_id',
                'chapter_id',
            ])
            ->whereHas('course', function ($querry) {
                $querry->where('institution_id', auth()->user()->institution->id);
            })
            ->with(['course:id,name', 'chapter:id,name'])
            ->orderByDesc('created_at')
            ->get();
    }

    public function stored($attributes): Model|Builder|Question
    {
        $interro = Question::query()
            ->create([
                'rating' => $attributes->input('rating'),
                'date' => $attributes->input('date'),
                'duration' => $attributes->input('duration'),
                'status' => StatusEnum::FALSE,
                'course_id' => $attributes->input('course'),
                'chapter_id' => $attributes->input('chapter'),
            ]);
        $this->messageService->success('Une nouvelle Interrogation a ete ajouter');

        return $interro;
    }

    public function updated(string $key, $attributes): Model|Builder|Question|null
    {
        $interro = $this->showInterro($key);
        $interro->update([
            'rating' => $attributes->input('rating'),
            'date' => $attributes->input('date'),
            'duration' => $attributes->input('duration'),
            'course_id' => $attributes->input('course'),
            'chapter_id' => $attributes->input('chapter'),
        ]);
        $this->messageService->success("L'Interrogation de {$interro->course->name} a ete modifier");

        return $interro;
    }

    public function showInterro(string $key): Model|Builder|Question|null
    {
        $interro = Question::query()
            ->select([
                'id',
                'rating',
                'date',
                'duration',
                'course_id',
                'chapter_id',
                'status',
            ])
            ->where('id', '=', $key)
            ->first();

        return $interro->load(['course:id,name,images', 'chapter:id,name']);
    }

    public function deleted(string $key): Model|Builder|Question|null
    {
        $interro = $this->showInterro($key);
        $interro->delete();
        $this->messageService->success('Une nouvelle Interrogation a ete supprimer');

        return $interro;
    }
}
