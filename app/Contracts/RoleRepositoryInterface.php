<?php

declare(strict_types=1);

namespace App\Contracts;

interface RoleRepositoryInterface
{
    public function getRoles();

    public function showRole(int $key);

    public function stored($attributes, $flash);

    public function updated(int $key, $attributes, $flash);

    public function deleted(int $key, $flash);
}
