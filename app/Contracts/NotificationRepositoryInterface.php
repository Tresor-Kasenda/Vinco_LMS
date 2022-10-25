<?php

declare(strict_types=1);

namespace App\Contracts;

interface NotificationRepositoryInterface
{
    public function notifications();

    public function showNotification(string $key);

    public function stored($attributes);

    public function updated(string $key, $attributes);

    public function deleted(string $key);
}
