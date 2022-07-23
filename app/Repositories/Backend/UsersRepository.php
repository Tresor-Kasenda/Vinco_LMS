<?php

declare(strict_types=1);

namespace App\Repositories\Backend;

use App\Contracts\UsersRepositoryInterface;
use App\Enums\StatusEnum;
use App\Models\User;
use App\Services\ToastMessageService;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Hash;

class UsersRepository implements UsersRepositoryInterface
{
    public function __construct(protected ToastMessageService $service)
    {
    }

    public function getUsers(): array|Collection
    {
        if (auth()->user()->hasRole('Super Admin')) {
            return User::query()
                ->select([
                    'name',
                    'email',
                    'status',
                    'id',
                    'institution_id'
                ])
                ->whereHas('roles', function ($query) {
                    $query->whereIn('name', ['Super Admin', 'Admin']);
                })
                ->with('institution:id,institution_name,institution_email')
                ->orderByDesc('created_at')
                ->get();
        }
        return User::query()
            ->select([
                'name',
                'email',
                'status',
                'id',
                'institution_id'
            ])
            ->with('institution:id,institution_name,institution_email')
            ->whereHas('roles', function ($query) {
                $query->whereIn('name', ['Super Admin', 'Admin']);
            })
            ->where('institution_id', '=', auth()->user()->institution->id)
            ->orderByDesc('created_at')
            ->get();
    }

    public function showUser(string $key): Model|Builder|User|null
    {
        $admin =  User::query()
            ->select([
                'name',
                'email',
                'status',
                'id',
                'institution_id'
            ])
            ->where('id', '=', $key)
            ->first();

        return $admin->load(['institution:id,institution_name,institution_email']);
    }

    public function stored($attributes): Model|Builder|User|RedirectResponse
    {
        $user = User::query()
            ->create([
                'name' => $attributes->input('name'),
                'email' => $attributes->input('email'),
                'status' => StatusEnum::TRUE,
                'password' => Hash::make($attributes->input('password')),
                'institution_id' => $attributes->input('institution')
            ]);

        $user->attachRole($attributes->input('role_id'));
        $this->service->success("Utilisateur ajouter avec succes");

        return $user;
    }

    public function updated(string $key, $attributes): Model|Builder|User|null
    {
        $user = $this->showUser(key: $key);

        $user->update([
            'name' => $attributes->input('name'),
            'email' => $attributes->input('email'),
            'password' => Hash::make($attributes->input('password')),
            'institution_id' => $attributes->input('institution')
        ]);
        $user->roles()->sync($attributes->input('role_id'));
        $this->service->success("Utilisateur mise a jours avec succes");

        return $user;
    }

    public function deleted(string $key): Model|Builder|User|RedirectResponse|null
    {
        $user = $this->showUser(key: $key);
        if ($user->status !== StatusEnum::FALSE || $user->hasRole('Super Admin')) {
            $this->service->error("Veillez desactiver le admin avant de le mettre dans la corbeille");

            return back();
        }
        $user->roles()->detach();
        $user->delete();
        $this->service->error("Utilisateur supprimer avec succes");

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
