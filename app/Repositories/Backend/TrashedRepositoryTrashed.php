<?php

declare(strict_types=1);

namespace App\Repositories\Backend;

use App\Contracts\TrashedPersonnelRepositoryInterface;
use App\Models\Campus;
use App\Traits\ImageUploader;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\RedirectResponse;

final class TrashedRepositoryTrashed implements TrashedPersonnelRepositoryInterface
{
    use ImageUploader;

    public function getTrashes(): array|Collection
    {
        return Campus::onlyTrashed()
            ->orderByDesc('created_at', 'desc')
            ->get();
    }

    public function restore(string $key, $alert)
    {
        $campus = $this->getTrashedCampus($key);
        $campus->restore();
        $alert->addSuccess('Le campus a ete restorer avec success');

        return $campus;
    }

    public function deleted(string $key, $alert): RedirectResponse
    {
        $campus = $this->getTrashedCampus($key);
        $this->removePathOfImages(model: $campus);
        $campus->forceDelete();
        $alert->addInfo('Campus supprimer definivement avec succes');

        return back();
    }

    public function getTrashedCampus(string $key): mixed
    {
        return Campus::withTrashed()
            ->when('key', function ($query) use ($key) {
                $query->where('key', $key);
            })
            ->first();
    }
}
