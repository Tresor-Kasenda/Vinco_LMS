<?php

declare(strict_types=1);

namespace App\Repositories\Backend;

use App\Contracts\TrashedCategoryRepositoryInterface;
use App\Models\Category;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\RedirectResponse;

final class TrashedCategoryRepository implements TrashedCategoryRepositoryInterface
{
    public function getTrashes(): array|Collection
    {
        return Category::onlyTrashed()
            ->orderByDesc('created_at', 'desc')
            ->get();
    }

    public function restore(string $key, $alert)
    {
        $department = $this->getTrashedCategory(key: $key);
        $department->restore();
        $alert->addSuccess('La categorie a ete restorer avec success');

        return $department;
    }

    public function deleted(string $key, $alert): RedirectResponse
    {
        $department = $this->getTrashedCategory(key: $key);
        $department->forceDelete();
        $alert->addInfo('Categorie supprimer definivement avec succes');

        return back();
    }

    public function getTrashedCategory(string $key): mixed
    {
        return Category::withTrashed()
            ->when('key', function ($query) use ($key) {
                $query->where('key', $key);
            })
            ->first();
    }
}
