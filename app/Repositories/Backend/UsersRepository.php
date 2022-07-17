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

class UsersRepository implements UsersRepositoryInterface
{
    public function getUsers(): array|Collection
    {
        return User::query()
            ->select([
                'name',
                'email',
                'status',
                'id',
            ])
            ->whereHas('roles', function ($query) {
                $query->whereIn('name', ['Super Admin', 'Admin']);
            })
            ->orderByDesc('created_at')
            ->get();
    }

    public function showUser(string $key): Model|Builder|User|null
    {
        return User::query()
            ->where('id', '=', $key)
            ->first();
    }

    public function stored($attributes, $flash): Model|Builder|User|RedirectResponse
    {
        $user = User::query()
            ->where('email', '=', $attributes->input('email'))
            ->first();
        if ($user) {
            $flash->addError('Email deja utiliser par un autre compte');

            return back();
        }
        $user = User::query()
            ->create([
                'name' => $attributes->input('name'),
                'email' => $attributes->input('email'),
                'status' => StatusEnum::TRUE,
                'password' => Hash::make($attributes->input('password')),
            ]);

        $user->attachRole($attributes->input('role_id'));
        $flash->addSuccess('Utilisateur ajouter avec succes');

        return $user;
    }

    public function updated(string $key, $attributes, $flash): Model|Builder|User|null
    {
        $user = $this->showUser(key: $key);
        $user->update([
            'name' => $attributes->input('name'),
            'email' => $attributes->input('email'),
            'password' => Hash::make($attributes->input('password')),
        ]);
        $user->syncRoles($attributes->input('role_id'));
        $flash->addSuccess('Utilisateur mise a jours avec succes');

        return $user;
    }

    public function deleted(string $key, $flash): Model|Builder|User|RedirectResponse|null
    {
        $user = $this->showUser(key: $key);
        if ($user->status !== StatusEnum::FALSE) {
            $flash->addError('Veillez desactiver le admin avant de le mettre dans la corbeille');

            return back();
        }
        $user->roles()->detach();
        $user->delete();
        $flash->addSuccess('Utilisateur supprimer avec succes');

        return $user;
    }

    public function changeStatus($attributes): bool|int
    {
        $user = $this->showUser(key: $attributes->input('key'));
        if ($user != null) {
            return $user->update([
                'status' => $attributes->input('status'),
            ]);
        }

        return false;
    }
}
