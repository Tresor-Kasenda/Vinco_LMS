<?php

declare(strict_types=1);

namespace App\Contracts;

use App\Models\Role;

interface RoleRepositoryInterface
{
    public function getRoles();

    public function stored($attributes);

    public function updated(Role $role, $attributes);

    public function deleted(Role $role);
}
