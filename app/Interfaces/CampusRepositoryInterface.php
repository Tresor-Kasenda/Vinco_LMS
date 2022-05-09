<?php
declare(strict_types=1);

namespace App\Interfaces;

interface CampusRepositoryInterface
{
    public function getCampuses();

    public function showCampus(string $key);

    public function stored($attributes, $factory);

    public function updated(string $key, $attributes, $factory);

    public function deleted(string $key, $factory);

    public function changeStatus($attributes);

}
