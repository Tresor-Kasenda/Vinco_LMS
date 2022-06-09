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
            ->with('lesson')
            ->orderByDesc('created_at')
            ->get();
    }

    public function showResource(string $key): Model|Resource|Builder
    {
        $resource = Resource::query()
            ->where('key', '=', $key)
            ->firstOrCreate();

        return $resource->load('lesson');
    }

    public function stored($attributes, $factory): Model|Resource|Builder|RedirectResponse
    {
        $lesson = Resource::query()
            ->when('name', function ($query) use ($attributes) {
                $query->where('name', $attributes->input('name'));
            })
            ->first();
        if (! $lesson) {
            $lesson = Resource::query()
                ->create([
                    'lesson_id' => $attributes->input('lesson'),
                    'status' => StatusEnum::TRUE,
                    'name' => $attributes->input('name'),
                    'files' => $attributes->file('content')->getClientOriginalName(),
                    'path' => self::uploadPDFFile($attributes),
                ]);
            $factory->addSuccess('Une nouvelle resource ajouter a la lecon');

            return $lesson;
        }
        $factory->addError('Nom du resource existe deja pour ce chapitre');

        return back();
    }

    public function updated(string $key, $attributes, $factory): Model|Resource|Builder
    {
        $lesson = $this->showResource(key: $key);
        $this->removePDFFiles($lesson);
        $lesson->update([
            'lesson_id' => $attributes->input('lesson'),
            'name' => $attributes->input('name'),
            'files' => $attributes->file('content')->getClientOriginalName(),
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
