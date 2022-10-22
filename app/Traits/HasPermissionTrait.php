<?php

declare(strict_types=1);

namespace App\Traits;

use App\Models\Permission;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

trait HasPermissionTrait
{
    public function hasRole(...$roles): bool
    {
        foreach ($roles as $role) {
            if ($this->roles->contains('name', $role)) {
                return true;
            }
        }

        return false;
    }

    public function hasPermission($permission): bool
    {
        return $this->hasPermissionThroughRole($permission) ||
            (bool) $this->permissions->where('name', $permission)->count();

        return $this->hasPermissionThroughRole($permission) ||
            (bool) $this->permissions->where('name', $permission->name)->count();
    }

    public function hasPermissionThroughRole($permission): bool
    {
        if($this->roles->contains($permission)){
            return true;
        }
//        foreach ($permission->roles as $role) {
//            if ($this->roles->contains($role)) {
//                return true;
//            }
//        }

        return false;
    }

    public function removePermission(...$permission): static
    {
        $permissions = $this->getPermissions(array_flatten($permission));
        $this->permissions()->detach($permissions);

        return $this;
    }

    public function getPermissions(array $permissions): Collection|array
    {
        return Permission::query()
            ->whereIn('name', $permissions)
            ->get();
    }

    public function modifyPermission(...$permissions): User
    {
        $this->permissions()->detach();

        return $this->givePermission($permissions);
    }

    public function givePermission(...$permission): static
    {
        $permissions = $this->getPermissions(array_flatten($permission));
        $this->permissions()->saveMany($permissions);

        return $this;
    }
}
