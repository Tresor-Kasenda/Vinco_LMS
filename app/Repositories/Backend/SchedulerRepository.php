<?php

declare(strict_types=1);

namespace App\Repositories\Backend;

use App\Contracts\SchedulerRepositoryInterface;

class SchedulerRepository implements SchedulerRepositoryInterface
{
    public function render(): array
    {
        return [];
    }

    public function showSchedule(string $key)
    {
        // TODO: Implement showSchedule() method.
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
