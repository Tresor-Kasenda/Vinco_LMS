<?php

declare(strict_types=1);

namespace App\Repositories\System;

use App\Contracts\RoleRepositoryInterface;
use App\Models\Role;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

final class RoleRepository implements RoleRepositoryInterface
{
    public function getRoles(): Collection|array
    {
        return Role::query()
            ->select([
                'id',
                'name',
            ])
            ->with('permissions')
            ->orderByDesc('created_at')
            ->get();
    }

    public function stored($attributes, $flash): Model|Builder
    {
        $role = Role::query()
            ->create([
                'name' => $attributes->input('name'),
            ]);
        $role->permissions()->sync($attributes->input('permission'));

        $flash->addSuccess('New role as added with successfully');

        return $role;
    }

    public function updated(int $key, $attributes, $flash): Model|Builder
    {
        $role = $this->showRole(key: $key);
        $role->update([
            'name' => $attributes->input('name'),
        ]);

        $role->permissions()->sync($attributes->input('permission'));

        $flash->addSuccess('New role as updated with successfully');

        return $role;
    }

    public function showRole(int $key): Model|Builder
    {
        return Role::query()
            ->select([
                'id',
                'name',
            ])
            ->where('id', '=', $key)
            ->firstOrFail();
    }

    public function deleted(int $key, $flash): Model|Builder
    {
        $role = $this->showRole(key: $key);
        $role->delete();
        $role->permissions()->detach();
        $flash->addSuccess('New role as deleted with successfully');

        return $role;
    }
}
