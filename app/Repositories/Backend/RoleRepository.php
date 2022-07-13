<?php

declare(strict_types=1);

namespace App\Repositories\Backend;

use App\Contracts\RoleRepositoryInterface;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Role;

class RoleRepository implements RoleRepositoryInterface
{
    public function getRoles(): Collection|array
    {
        return Role::query()
            ->orderByDesc('created_at')
            ->get();
    }

    public function showRole(int $key): Model|Builder
    {
        return Role::query()
            ->where('id', '=', $key)
            ->firstOrFail();
    }

    public function stored($attributes, $flash): Model|Builder
    {
        $role = Role::query()
            ->create([
                'name' => $attributes->input('name'),
            ]);
        $role->givePermissionTo($attributes->input('permission'));

        $flash->addSuccess('New role as added with successfully');

        return $role;
    }

    public function updated(int $key, $attributes, $flash): Model|Builder
    {
        $role = $this->showRole(key: $key);
        $role->update([
            'name' => $attributes->input('name'),
        ]);

        $role->syncPermissions($attributes->input('permission'));

        $flash->addSuccess('New role as updated with successfully');

        return $role;
    }

    public function deleted(int $key, $flash): Model|Builder
    {
        $role = $this->showRole(key: $key);
        $role->delete();
        $flash->addSuccess('New role as deleted with successfully');

        return $role;
    }
}
