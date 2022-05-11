<?php
declare(strict_types=1);

namespace App\Repositories\Backend;

use App\Interfaces\TrashedDepartmentRepositoryInterface;
use App\Models\Department;
use App\Traits\ImageUploader;
use Illuminate\Database\Eloquent\Collection;

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
        // TODO: Implement restore() method.
    }

    public function deleted(string $key, $alert)
    {
        // TODO: Implement deleted() method.
    }
}
