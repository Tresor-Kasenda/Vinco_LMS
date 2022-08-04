<?php

declare(strict_types=1);

namespace App\Contracts;

interface CampusRepositoryInterface
{
    public function getCampuses();

    public function showCampus(string $key);

    public function stored($attributes);

    public function updated(string $key, $attributes);

    public function deleted(string $key);

    public function changeStatus($attributes);
}
