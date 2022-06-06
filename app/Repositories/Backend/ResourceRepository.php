<?php

declare(strict_types=1);

namespace App\Repositories\Backend;

use App\Contracts\ResourceRepositoryInterface;
use App\Models\Resource;
use Illuminate\Database\Eloquent\Collection;

class ResourceRepository implements ResourceRepositoryInterface
{
    public function resources(): array|Collection
    {
        return Resource::query()
            ->with('lesson')
            ->orderByDesc('created_at')
            ->get();
    }

    public function showResource(string $key)
    {
        // TODO: Implement showResource() method.
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
}
