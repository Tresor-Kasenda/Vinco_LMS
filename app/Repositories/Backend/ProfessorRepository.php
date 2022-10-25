<?php

declare(strict_types=1);

namespace App\Repositories\Backend;

use App\Contracts\ProfessorRepositoryInterface;
use App\Models\Professor;
use App\Models\User;
use App\Traits\ImageUploader;
use App\Traits\RandomValue;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Hash;
use LaravelIdea\Helper\App\Models\_IH_User_QB;
use Spatie\Permission\Models\Role;

final class ProfessorRepository implements ProfessorRepositoryInterface
{
    use ImageUploader;
    use RandomValue;

    public function getProfessors(): Collection|array
    {
        if (\Auth::user()->hasRole('Super Admin')) {
            return Professor::query()
                ->select([
                    'id',
                    'images',
                    'username',
                    'email',
                    'phones',
                    'matriculate',
                    'user_id',
                ])
                ->with('user')
                ->orderByDesc('created_at')
                ->get();
        }

        return Professor::query()
            ->select([
                'id',
                'images',
                'username',
                'email',
                'phones',
                'matriculate',
                'user_id',
            ])
            ->whereHas(
                'user',
                fn ($query) => $query->where('institution_id', '=', auth()->user()->institution_id)
            )
            ->orderByDesc('created_at')
            ->get();
    }

    public function stored($attributes): Model|Builder|RedirectResponse
    {
        $user = $this->createUser($attributes);
        $role = $this->getRole();
        $user->assignRole([$role->id]);
        $user->givePermissionTo($role->permissions);

        return $this->createProfessor($attributes, $user);
    }

    private function createUser($attributes): _IH_User_QB|Model|Builder|User|RedirectResponse|null
    {
        $user = User::query()
            ->where('email', '=', $attributes->input('email'))
            ->first();
        if (! $user) {
            return User::query()
                ->create([
                    'name' => $attributes->input('name'),
                    'email' => $attributes->input('email'),
                    'institution_id' => $attributes->input('institution') ?? \Auth::user()->institution_id,
                    'password' => Hash::make($attributes->input('password')),
                ]);
        }

        return null;
    }

    private function getRole(): Builder|Model
    {
        return Role::query()
            ->where('name', '=', 'Professeur')
            ->first();
    }

    private function createProfessor($attributes, $user): Model|Builder
    {
        return Professor::query()
            ->create([
                'username' => $attributes->input('name'),
                'lastname' => $attributes->input('lastname'),
                'email' => $attributes->input('email'),
                'phones' => $attributes->input('phones'),
                'images' => self::uploadFiles($attributes),
                'gender' => $attributes->input('gender'),
                'user_id' => $user->id,
                'matriculate' => $this->generateRandomTransaction(10),
            ]);
    }

    public function updated(string $key, $attributes): Model|Builder|null
    {
        $professor = $this->showProfessor(key: $key);
        $user = $this->getUser($professor);
        $professor->update([
            'username' => $attributes->input('name'),
            'lastname' => $attributes->input('lastname'),
            'email' => $attributes->input('email'),
            'phones' => $attributes->input('phones'),
            'gender' => $attributes->input('gender'),
        ]);
        $role = $this->getRole();
        $user->syncRoles([$role->id]);
        $user->syncPermissions($role->permissions);

        return $professor;
    }

    public function showProfessor(string $key): Model|Builder|null
    {
        $professor = Professor::query()
            ->select([
                'id',
                'username',
                'firstname',
                'lastname',
                'email',
                'phones',
                'matriculate',
                'country',
                'images',
                'location',
                'identityCard',
                'gender',
                'birthdays',
                'user_id',
                'created_at',
                'updated_at',
            ])
            ->whereId($key)
            ->first();

        return $professor->load(['courses:id,name', 'user']);
    }

    private function getUser(Model|Builder|null $professor): Model|_IH_User_QB|Builder|User|null
    {
        return User::query()
            ->where('id', '=', $professor->user_id)
            ->first();
    }

    public function deleted(string $key): RedirectResponse
    {
        $professor = $this->showProfessor(key: $key);
        $professor->delete();

        return back();
    }
}
