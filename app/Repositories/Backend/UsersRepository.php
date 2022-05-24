<?php

declare(strict_types=1);

namespace App\Repositories\Backend;

use App\Enums\RoleEnum;
use App\Enums\StatusEnum;
use App\Interfaces\UsersRepositoryInterface;
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
            ->orderByDesc('created_at')
            ->latest()
            ->get();
    }

    public function showUser(string $key): Model|Builder|User|null
    {
        $user = User::query()
            ->where('key', '=', $key)
            ->first();

        return $user->load('role');
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
                'firstName' => $attributes->input('firstName'),
                'email' => $attributes->input('email'),
                'role_id' => $attributes->input('role_id'),
                'status' => StatusEnum::TRUE,
                'password' => Hash::make($attributes->input('password')),
            ]);
        $flash->addSuccess('Utilisateur ajouter avec succes');

        return $user;
    }

    public function updated(string $key, $attributes, $flash): Model|Builder|User|null
    {
        $user = $this->showUser(key: $key);
        $user->update([
            'name' => $attributes->input('name'),
            'firstName' => $attributes->input('firstName'),
            'email' => $attributes->input('email'),
            'role_id' => $attributes->input('role_id'),
            'password' => Hash::make($attributes->input('password')),
        ]);
        $flash->addSuccess('Utilisateur mise a jours avec succes');

        return $user;
    }

    public function deleted(string $key, $flash): Model|Builder|User|RedirectResponse|null
    {
        $user = $this->showUser(key: $key);
        if ($user->status !== StatusEnum::FALSE) {
            $flash->addError('Veillez desactiver le users avant de le mettre dans la corbeille');

            return back();
        }
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
