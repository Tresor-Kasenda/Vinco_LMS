<?php

declare(strict_types=1);

namespace App\Contracts;

interface FiliaireRepositoryInterface
{
    public function getFiliaires();

    public function showFiliaire(string $key);

    public function stored($attributes, $factory);

    public function updated(string $key, $attributes, $factory);

    public function deleted(string $key, $factory);

    public function changeStatus($attributes);
}
