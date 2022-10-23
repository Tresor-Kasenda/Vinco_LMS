<?php

declare(strict_types=1);

namespace App\Repositories\System;

use App\Http\Requests\Permission\StorePermissionRequest;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Permission;

class PermissionBackendRepository
{
    public function store(StorePermissionRequest $request): Model|Builder
    {
        return Permission::query()
            ->create([
                'name' => $request->input('name'),
            ]);
    }

    public function update(Permission $permission, StorePermissionRequest $request): bool
    {
        return $permission->update([
            'name' => $request->input('name'),
        ]);
    }

    public function delete(Permission $permission): Permission
    {
        $permission->delete();

        return $permission;
    }
}
