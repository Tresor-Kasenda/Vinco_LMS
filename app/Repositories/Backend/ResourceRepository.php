<?php

declare(strict_types=1);

namespace App\Repositories\Backend;

use App\Contracts\ResourceRepositoryInterface;
use App\Enums\StatusEnum;
use App\Models\Resource;
use App\Traits\ImageUploader;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\RedirectResponse;

class ResourceRepository implements ResourceRepositoryInterface
{
    use ImageUploader;

    public function resources(): array|Collection
    {
        return Resource::query()
            ->select([
                'id',
                'name',
                'lesson_id',
                'chapter_id'
            ])
            ->with(['lesson:id,name', 'chapter:id,name,course_id'])
            ->orderByDesc('created_at')
            ->get();
    }

    public function showResource(string $key): Model|Resource|Builder
    {
        $resource = Resource::query()
            ->select([
                'id',
                'name',
                'lesson_id',
                'chapter_id',
                'files',
                'path'
            ])
            ->where('id', '=', $key)
            ->first();

        return $resource->load([
            'lesson:id,name,chapter_id',
            'chapter:id,name,course_id',
            'chapter.course:id,name,images'
        ]);
    }

    public function stored($attributes, $factory): Model|Resource|Builder|RedirectResponse
    {
        $lesson = Resource::query()
            ->create([
                'lesson_id' => $attributes->input('lesson'),
                'chapter_id' => $attributes->input('chapter'),
                'name' => $attributes->input('name'),
                'files' => $attributes->file('files')->getClientOriginalName(),
                'path' => self::uploadPDFFile($attributes),
            ]);
        $factory->addSuccess('Une nouvelle resource ajouter a la lecon');

        return $lesson;
    }

    public function updated(string $key, $attributes, $factory): Model|Resource|Builder
    {
        $lesson = $this->showResource(key: $key);
        $this->removePDFFiles($lesson);
        $lesson->update([
            'lesson_id' => $attributes->input('lesson'),
            'chapter_id' => $attributes->input('chapter'),
            'name' => $attributes->input('name'),
            'files' => $attributes->file('files')->getClientOriginalName(),
            'path' => self::uploadPDFFile($attributes),
        ]);
        $factory->addSuccess('Une lecon a ete mise a jours avec success');

        return $lesson;
    }

    public function deleted(string $key, $factory): Model|Resource|Builder
    {
        $lesson = $this->showResource(key: $key);
        $lesson->delete();
        $factory->addSuccess('La lesson a ete supprimer avec success');

        return $lesson;
    }
}
