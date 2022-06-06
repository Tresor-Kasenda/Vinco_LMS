<?php

declare(strict_types=1);

namespace App\Repositories\Backend;

use App\Contracts\FeesTypeRepositoryInterface;
use App\Models\IncomeType;

class FeesTypeRepository implements FeesTypeRepositoryInterface
{
    public function getFeesTypes()
    {
        return IncomeType::query()
            ->orderByDesc('created_at')
            ->get();
    }

    public function showFeeType(string $key)
    {
        // TODO: Implement showFeeType() method.
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
