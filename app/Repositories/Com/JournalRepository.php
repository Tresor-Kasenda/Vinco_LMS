<?php

declare(strict_types=1);

namespace App\Repositories\Com;

use App\Contracts\JournalRepositoryInterface;

final class JournalRepository implements JournalRepositoryInterface
{
    public function results()
    {
        // TODO: Implement results() method.
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
