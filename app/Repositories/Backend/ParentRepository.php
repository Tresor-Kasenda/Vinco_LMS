<?php

declare(strict_types=1);

namespace App\Repositories\Backend;

use App\Contracts\ParentRepositoryInterface;
use App\Models\Guardian;
use App\Traits\ImageUploader;
use Illuminate\Database\Eloquent\Collection;

class ParentRepository implements ParentRepositoryInterface
{
    use ImageUploader;

    public function guardians(): Collection|array
    {
        return Guardian::query()
            ->orderByDesc('created_at')
            ->get();
    }

    public function showGuardian(string $key)
    {
        // TODO: Implement showGuardian() method.
    }

    public function stored($attributes, $factory)
    {
        // TODO: Implement stored() method.
    }

    public function updated(string $key, $attributes, $factory)
    {
        // TODO: Implement updated() method.
    }

    public function deleted(string $key, $factory)
    {
        // TODO: Implement deleted() method.
    }

    public function changeStatus($attributes)
    {
        // TODO: Implement changeStatus() method.
    }
}
