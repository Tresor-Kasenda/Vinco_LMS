<?php

declare(strict_types=1);

namespace App\Interfaces;

interface TrashedCampusRepositoryInterface
{
    public function getTrashes();

    public function restore(string $key, $alert);

    public function deleted(string $key, $alert);
}
