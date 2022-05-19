<?php
declare(strict_types=1);

namespace App\Repositories\Backend;

use App\Interfaces\TrashedCourseRepositoryInterface;
use App\Models\Course;
use App\Traits\ImageUploader;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\RedirectResponse;

class TrashedCourseRepository implements TrashedCourseRepositoryInterface
{
    use ImageUploader;

    public function getTrashes(): array|Collection
    {
        return Course::onlyTrashed()
            ->orderByDesc('created_at', 'desc')
            ->get();
    }

    public function restore(string $key, $alert)
    {
        $campus = $this->getTrashedProfessor($key);
        $campus->restore();
        $alert->addSuccess("Le cours a ete restorer avec success");
        return $campus;
    }

    public function deleted(string $key, $alert): RedirectResponse
    {
        $professor = $this->getTrashedProfessor($key);
        $this->removePathOfImages(model: $professor);
        $professor->user->forceDelete();
        $professor->forceDelete();
        $alert->addInfo("Cours supprimer definivement avec succes");
        return back();
    }

    public function getTrashedProfessor(string $key): mixed
    {
        return Course::withTrashed()
            ->when('key', function ($query) use ($key) {
                $query->where('key', $key);
            })
            ->first();
    }
}
