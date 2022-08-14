<?php

declare(strict_types=1);

namespace App\Repositories\Backend;

use App\Contracts\ResourceRepositoryInterface;
use App\Models\Resource;
use App\Services\ToastMessageService;
use App\Traits\ImageUploader;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\RedirectResponse;

final class ResourceRepository implements ResourceRepositoryInterface
{
    use ImageUploader;

    public function __construct(protected ToastMessageService $messageService)
    {
    }

    public function resources(): array|Collection
    {
        if (auth()->user()->hasRole('Super Admin')) {
            return Resource::query()
                ->select([
                    'id',
                    'name',
                    'lesson_id',
                    'chapter_id',
                    'path'
                ])
                ->with(['lesson:id,name', 'chapter:id,name,course_id'])
                ->orderByDesc('created_at')
                ->get();
        }

        return Resource::query()
            ->select([
                'id',
                'name',
                'lesson_id',
                'chapter_id',
                'path'
            ])
            ->with(['lesson:id,name', 'chapter:id,name,course_id'])
            ->whereHas('chapter', function ($query) {
                $query->whereHas('course', function ($query) {
                    $query->where('institution_id', auth()->user()->institution->id);
                });
            })
            ->orderByDesc('created_at')
            ->get();
    }

    public function stored($attributes): Model|Resource|Builder|RedirectResponse
    {
        $lesson = Resource::query()
            ->create([
                'lesson_id' => $attributes->input('lesson'),
                'chapter_id' => $attributes->input('chapter'),
                'name' => $attributes->input('name'),
                'files' => $attributes->file('files'),
                'path' => self::uploadPDFFile($attributes),
            ]);
        $this->messageService->success('Une nouvelle resource ajouter a la lecon');

        return $lesson;
    }

    public function updated(string $key, $attributes): Model|Resource|Builder
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
        $this->messageService->success("Une lecon a ete mise a jours avec success");

        return $lesson;
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
                'path',
            ])
            ->where('id', '=', $key)
            ->first();

        return $resource->load([
            'lesson:id,name,chapter_id',
            'chapter:id,name,course_id',
            'chapter.course:id,name,images',
        ]);
    }

    public function deleted(string $key): Model|Resource|Builder
    {
        $lesson = $this->showResource(key: $key);
        $lesson->delete();
        $this->messageService->success("La lesson a ete supprimer avec success");
        return $lesson;
    }
}
