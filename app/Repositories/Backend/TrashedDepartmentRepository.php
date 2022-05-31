<?php

declare(strict_types=1);

namespace App\Repositories\Backend;

use App\Contracts\TrashedDepartmentRepositoryInterface;
use App\Models\Department;
use App\Traits\ImageUploader;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\RedirectResponse;

class TrashedDepartmentRepository implements TrashedDepartmentRepositoryInterface
{
    use ImageUploader;

    public function getTrashes(): array|Collection
    {
        return Department::onlyTrashed()
            ->orderByDesc('created_at', 'desc')
            ->get();
    }

    public function restore(string $key, $alert)
    {
        $department = $this->getTrashedDepartment(key: $key);
        $department->restore();
        $alert->addSuccess('Le departement a ete restorer avec success');

        return $department;
    }

    public function deleted(string $key, $alert): RedirectResponse
    {
        $department = $this->getTrashedDepartment(key: $key);
        $this->removePathOfImages(model: $department);
        $department->forceDelete();
        $alert->addInfo('Departement supprimer definivement avec succes');

        return back();
    }

    public function getTrashedDepartment(string $key): mixed
    {
        return Department::withTrashed()
            ->when('key', function ($query) use ($key) {
                $query->where('key', $key);
            })
            ->first();
    }
}
