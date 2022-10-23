<?php

declare(strict_types=1);

namespace App\Repositories\Backend;

use App\Contracts\UsersRepositoryInterface;
use App\Enums\StatusEnum;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

final class UsersRepository implements UsersRepositoryInterface
{
    public function getUsers(): array|Collection
    {
        if (auth()->user()->hasRole('Super Admin')) {
            return User::query()
                ->select([
                    'name',
                    'email',
                    'status',
                    'id',
                    'institution_id',
                ])
                ->whereHas('roles', function ($query) {
                    $query->whereIn('name', ['Super Admin', 'Admin']);
                })
                ->with([
                    'institution:id,institution_name,institution_email',
                    'permissions',
                ])
                ->orderByDesc('created_at')
                ->get();
        }

        return User::query()
            ->select([
                'name',
                'email',
                'status',
                'id',
                'institution_id',
            ])
            ->with('institution:id,institution_name,institution_email')
            ->whereHas('roles', function ($query) {
                $query->whereIn('name', ['Super Admin', 'Admin']);
            })
            ->where('institution_id', '=', auth()->user()->institution->id)
            ->orderByDesc('created_at')
            ->get();
    }

    public function stored($attributes): Model|Builder|User|RedirectResponse
    {
        $role = Role::query()
            ->where('id', '=', $attributes->input('role_id'))
            ->first();

        $user = User::query()
            ->create([
                'name' => $attributes->input('name'),
                'email' => $attributes->input('email'),
                'status' => StatusEnum::TRUE,
                'password' => Hash::make($attributes->input('password')),
                'institution_id' => $attributes->input('institution'),
            ]);
        $user->assignRole([$role->id]);
        $user->givePermissionTo($role->permissions);

        return $user;
    }

    public function updated(string|int $key, $attributes): Model|Builder|User|null
    {
        $user = $this->showUser(key: $key);

        $user->update([
            'name' => $attributes->input('name'),
            'email' => $attributes->input('email'),
            'password' => Hash::make($attributes->input('password')),
            'institution_id' => $attributes->input('institution'),
        ]);

        $role = Role::query()
            ->where('id', '=', $attributes->input('role_id'))
            ->first();
        $user->syncRoles([$role->id]);
        $user->syncPermissions($role->permissions);

        return $user;
    }

    public function showUser(string|int $key): Model|Builder|User|null
    {
        $admin = User::query()
            ->select([
                'name',
                'email',
                'status',
                'id',
                'institution_id',
                'created_at',
                'updated_at',
            ])
            ->where('id', '=', $key)
            ->first();

        return $admin->load(['institution:id,institution_name,institution_email']);
    }

    public function deleted(string|int $key): Model|Builder|User|RedirectResponse|null
    {
        $user = $this->showUser(key: $key);
        $user->roles()->detach();
        $user->permissions()->detach();
        $user->delete();

        return $user;
    }
}
