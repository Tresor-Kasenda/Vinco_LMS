<?php

declare(strict_types=1);

namespace App\Repositories\Backend;

use App\Contracts\InterroRepositoryInterface;
use App\Enums\StatusEnum;
use App\Models\Question;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use LaravelIdea\Helper\App\Models\_IH_Question_QB;

final class InterroRepository implements InterroRepositoryInterface
{
    public function interros(): array|Collection|\Illuminate\Support\Collection
    {
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

    public function showInterro(string $key): Model|_IH_Question_QB|Builder|Question|null
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

    public function stored($attributes, $factory): Model|_IH_Question_QB|Builder|Question
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

        $factory->addSuccess('Une nouvelle Interrogation a ete ajouter');

        return $interro;
    }

    public function updated(string $key, $attributes, $factory): Model|_IH_Question_QB|Builder|Question|null
    {
        $interro = $this->showInterro($key);
        $interro->update([
            'rating' => $attributes->input('rating'),
            'date' => $attributes->input('date'),
            'duration' => $attributes->input('duration'),
            'course_id' => $attributes->input('course'),
            'chapter_id' => $attributes->input('chapter'),
        ]);
        $factory->addSuccess('Une nouvelle Interrogation a ete modifier');

        return $interro;
    }

    public function deleted(string $key, $factory): Model|_IH_Question_QB|Builder|Question|null
    {
        $interro = $this->showInterro($key);
        $interro->delete();
        $factory->addSuccess('Une nouvelle Interrogation a ete supprimer');

        return $interro;
    }
}
