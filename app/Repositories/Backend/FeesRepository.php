<?php

declare(strict_types=1);

namespace App\Repositories\Backend;

use App\Contracts\FeesRepositoryInterface;
use App\Models\Income;
use Illuminate\Database\Eloquent\Collection;

class FeesRepository implements FeesRepositoryInterface
{
    public function getFees(): Collection|array
    {
        return Income::query()
            ->orderByDesc('created_at')
            ->get();
    }

    public function showFee(string $key)
    {
        // TODO: Implement showFee() method.
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
