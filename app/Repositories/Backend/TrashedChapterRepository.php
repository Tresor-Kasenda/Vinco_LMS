<?php
declare(strict_types=1);

namespace App\Repositories\Backend;

use App\Interfaces\TrashedChapterRepositoryInterface;
use App\Models\Chapter;
use App\Traits\ImageUploader;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Collection;

class TrashedChapterRepository implements TrashedChapterRepositoryInterface
{
    public function getTrashes(): array|Collection
    {
        return Chapter::onlyTrashed()
            ->orderByDesc('created_at', 'desc')
            ->get();
    }

    public function restore(string $key, $alert)
    {
        $course = $this->getTrashedProfessor($key);
        $course->restore();
        $alert->addSuccess("Le chapitre a ete restorer avec success");
        return $course;
    }

    public function deleted(string $key, $alert): RedirectResponse
    {
        $course = $this->getTrashedProfessor($key);
        $course->forceDelete();
        $alert->addInfo("chapitre supprimer definivement avec succes");
        return back();
    }

    public function getTrashedProfessor(string $key): mixed
    {
        return Chapter::withTrashed()
            ->when('key', function ($query) use ($key) {
                $query->where('key', $key);
            })
            ->first();
    }
}
