<?php

declare(strict_types=1);

namespace App\Contracts;

interface FiliaireRepositoryInterface
{
    public function getFiliaires();

    public function showFiliaire(string $key);

    public function stored($attributes);

    public function updated(string $key, $attributes);

    public function deleted(string $key);

    public function changeStatus($attributes);
}
