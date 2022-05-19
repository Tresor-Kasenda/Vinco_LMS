<?php
declare(strict_types=1);

namespace App\Interfaces;

interface TrashedUsersRepositoryInterface
{
    public function getTrashes();

    public function restore(string $key, $alert);

    public function deleted(string $key, $alert);
}
