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
            ->select([
                'id',
                'name',
                'course_id'
            ])
            ->with('course:id,name')
            ->withCount(['lessons'])
            ->orderByDesc('created_at')
            ->get();
    }

    public function showChapter(string $key): Model|Builder|Chapter|null|array
    {
        $chapter = Chapter::query()
            ->select([
                'id',
                'name',
                'course_id',
                'content'
            ])
            ->where('id', '=', $key)
            ->first();

        return $chapter->load([
            'lessons:id,name',
            'course:id,name,professor_id,images',
            'course.professors:id,username,email,lastname',
            'resources:id,name,path'
        ]);
    }

    public function stored($attributes, $flash): Model|Builder|Chapter|RedirectResponse|array
    {
        $chapter = Chapter::query()
            ->create([
                'course_id' => $attributes->input('course'),
                'name' => $attributes->input('name'),
                'content' => $attributes->input('content'),
            ]);
        $flash->addSuccess('Un nouveau cours a ete ajouter');

        return $chapter;
    }

    public function updated(string $key, $attributes, $flash): Model|Builder|array|Chapter|null
    {
        $chapter = $this->showChapter(key: $key);

        $chapter->update([
            'course_id' => $attributes->input('course'),
            'name' => $attributes->input('name'),
            'content' => $attributes->input('content'),
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
