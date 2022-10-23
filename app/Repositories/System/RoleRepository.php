<?php

declare(strict_types=1);

namespace App\Repositories\System;

use App\Contracts\RoleRepositoryInterface;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Role;

final class RoleRepository implements RoleRepositoryInterface
{

    public function stored($attributes): Model|Builder
    {
        $role = Role::query()
            ->create([
                'name' => $attributes->input('name'),
            ]);
        $role->syncPermissions($attributes->input('permission'));
        return $role;
    }

    public function updated($role, $attributes): Model|Builder
    {
        $roles = $this->showRole($role);
        $roles->update([
            'name' => $attributes->input('name'),
        ]);
        $roles->syncPermissions($attributes->input('permission'));
        return $roles;
    }

    public function showRole($role): Model|Builder|null
    {
        return Role::query()
            ->where('id', '=', $role)
            ->first();
    }

    public function deleted($role): Model|Builder
    {
        $roles = $this->showRole($role);
        $roles->permissions()->detach();
        $roles->delete();
        return $roles;
    }
}
