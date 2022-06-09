<?php

declare(strict_types=1);

namespace App\Repositories\Backend;

use App\Contracts\LessonRepositoryInterface;
use App\Enums\StatusEnum;
use App\Models\Chapter;
use App\Models\Course;
use App\Models\Lesson;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\RedirectResponse;

class LessonRepository implements LessonRepositoryInterface
{
    public function getLessons(): array|Collection
    {
        return Lesson::query()
            ->with('chapter')
            ->orderByDesc('created_at')
            ->get();
    }

    public function showLesson(string $key)
    {
        $lesson = Lesson::query()
            ->when('key', fn ($query) => $query->where('key', $key))
            ->first();

        return $lesson->load('chapter');
    }

    public function stored($attributes, $flash): Lesson|Builder|Model|RedirectResponse
    {
        $lesson = Lesson::query()
            ->when('name', function ($query) use ($attributes) {
                $query->where('name', $attributes->input('name'));
            })
            ->first();
        if (! $lesson) {
            $lesson = Lesson::query()
                ->create([
                    'chapter_id' => $attributes->input('chapter'),
                    'status' => StatusEnum::TRUE,
                    'name' => $attributes->input('name'),
                    'shortContent' => $attributes->input('short_content'),
                    'content' => $attributes->input('content'),
                ]);
            $flash->addSuccess('Une nouvelle lecon a ete ajouter');

            return $lesson;
        }
        $flash->addError('Nom du lecon existe deja pour ce chapitre');

        return back();
    }

    public function updated(string $key, $attributes, $flash)
    {
        $lesson = $this->showLesson(key: $key);
        $lesson->update([
            'chapter_id' => $attributes->input('chapter'),
            'name' => $attributes->input('name'),
            'shortContent' => $attributes->input('short_content'),
            'content' => $attributes->input('content'),
        ]);
        $flash->addSuccess('Une lecon a ete mise a jours avec success');

        return $lesson;
    }

    public function deleted(string $key, $flash): array
    {
        $lesson = $this->showLesson(key: $key);
        $lesson->delete();
        $flash->addSuccess('La lesson a ete supprimer avec success');

        return $lesson;
    }
}
