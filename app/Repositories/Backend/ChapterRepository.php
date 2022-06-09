<?php

declare(strict_types=1);

namespace App\Repositories\Backend;

use App\Contracts\ChapterRepositoryInterface;
use App\Enums\StatusEnum;
use App\Models\Chapter;
use App\Traits\ImageUploader;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\RedirectResponse;

class ChapterRepository implements ChapterRepositoryInterface
{
    use ImageUploader;

    public function getChapters(): array|Collection
    {
        return Chapter::query()
            ->withCount(['lessons', 'exercises'])
            ->orderByDesc('created_at')
            ->get();
    }

    public function showChapter(string $key): Model|Builder|Chapter|null|array
    {
        $chapter = Chapter::query()
            ->where('key', '=', $key)
            ->first();

        return $chapter->load('lessons');
    }

    public function stored($attributes, $flash): Model|Builder|Chapter|RedirectResponse|array
    {
        $chapter = Chapter::query()
            ->when('name', function ($query) use ($attributes) {
                $query->where('name', $attributes->input('name'));
            })
            ->first();
        if (! $chapter) {
            $chapter = Chapter::query()
                ->create([
                    'course_id' => $attributes->input('course'),
                    'status' => StatusEnum::TRUE,
                    'name' => $attributes->input('name'),
                    'displayType' => $attributes->input('displayType'),
                    'description' => $attributes->input('description'),
                ]);
            $flash->addSuccess('Un nouveau cours a ete ajouter');

            return $chapter;
        }
        $flash->addError('Nom du cours ou le professeur a existe deja pour ce cours');

        return back();
    }

    public function updated(string $key, $attributes, $flash): Model|Builder|array|Chapter|null
    {
        $chapter = $this->showChapter(key: $key);

        $chapter->update([
            'course_id' => $attributes->input('course'),
            'name' => $attributes->input('name'),
            'displayType' => $attributes->input('displayType'),
            'description' => $attributes->input('description'),
        ]);
        $flash->addSuccess('Un cours a ete mise a jours avec success');

        return $chapter;
    }

    public function deleted(string $key, $flash): Model|Builder|array|Chapter|null
    {
        $chapter = $this->showChapter(key: $key);
        $chapter->delete();
        $flash->addSuccess('Le chapitre a ete supprimer avec success');

        return $chapter;
    }
}
