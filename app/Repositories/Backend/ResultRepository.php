<?php

declare(strict_types=1);

namespace App\Repositories\Backend;

use App\Contracts\ResultRepositoryInterface;

class ResultRepository implements ResultRepositoryInterface
{
    public function results()
    {
        return [];
    }

    public function showResult(string $key)
    {
        // TODO: Implement showResult() method.
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
