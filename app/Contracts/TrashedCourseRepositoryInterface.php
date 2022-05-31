<?php

declare(strict_types=1);

namespace App\Contracts;

interface TrashedCourseRepositoryInterface
{
    public function getTrashes();

    public function restore(string $key, $alert);

    public function deleted(string $key, $alert);
}
