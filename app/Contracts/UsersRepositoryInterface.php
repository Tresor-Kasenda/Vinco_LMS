<?php

declare(strict_types=1);

namespace App\Contracts;

interface UsersRepositoryInterface
{
    public function getUsers();

    public function showUser(string $key);

    public function stored($attributes, $flash);

    public function updated(string $key, $attributes, $flash);

    public function deleted(string $key, $flash);

    public function changeStatus($attributes);
}
