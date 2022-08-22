<?php

declare(strict_types=1);

namespace App\Repositories\Backend;

use App\Contracts\TrashedProfessorRepositoryInterface;
use App\Models\Professor;
use App\Traits\ImageUploader;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\RedirectResponse;

final class TrashedProfessorRepository implements TrashedProfessorRepositoryInterface
{
    use ImageUploader;

    public function getTrashes(): array|Collection
    {
        return Professor::onlyTrashed()
            ->orderByDesc('created_at', 'desc')
            ->get();
    }

    public function restore(string $key, $alert)
    {
        $campus = $this->getTrashedProfessor($key);
        $campus->restore();
        $alert->addSuccess('Le personnel a ete restorer avec success');

        return $campus;
    }

    public function deleted(string $key, $alert): RedirectResponse
    {
        $professor = $this->getTrashedProfessor($key);
        $this->removePathOfImages(model: $professor);
        $professor->user->forceDelete();
        $professor->forceDelete();
        $alert->addInfo('Personnel supprimer definivement avec succes');

        return back();
    }

    public function getTrashedProfessor(string $key): mixed
    {
        return Professor::withTrashed()
            ->when('key', function ($query) use ($key) {
                $query->where('key', $key);
            })
            ->first();
    }
}
