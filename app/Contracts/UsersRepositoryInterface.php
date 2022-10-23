<?php

declare(strict_types=1);

namespace App\Contracts;

interface UsersRepositoryInterface
{
    public function getUsers();

    public function showUser(string|int $key);

    public function stored($attributes);

    public function updated(string|int $key, $attributes);

    public function deleted(string|int $key);
}
