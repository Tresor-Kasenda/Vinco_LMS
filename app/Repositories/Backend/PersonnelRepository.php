<?php

declare(strict_types=1);

namespace App\Repositories\Backend;

use App\Contracts\PersonnelRepositoryInterface;
use App\Models\Personnel;
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

/**
 * class PersonnelRepository.
 */
final class PersonnelRepository implements PersonnelRepositoryInterface
{
    use ImageUploader;
    use RandomValue;

    public function getPersonnelContent(): Collection|array
    {
        if (auth()->user()->hasRole('Super Admin')) {
            return Personnel::query()
                ->select([
                    'images',
                    'matriculate',
                    'gender',
                    'username',
                    'id',
                    'phones',
                    'email',
                    'user_id',
                ])
                ->with('user')
                ->orderByDesc('created_at')
                ->get();
        }

        return Personnel::query()
            ->select([
                'images',
                'matriculate',
                'gender',
                'username',
                'id',
                'phones',
                'email',
                'user_id',
            ])
            ->whereHas('user', function ($institution) {
                $institution->where('institution_id', '=', auth()->user()->institution_id);
            })
            ->orderByDesc('created_at')
            ->get();
    }

    public function stored($attributes): Model|Builder|RedirectResponse
    {
        $personnel = User::query()
            ->where('email', '=', $attributes->input('email'))
            ->first();

        if (! $personnel) {
            $user = $this->storeManger($attributes);
            $role = $this->getRole($attributes);
            $user->assignRole([$role->id]);
            $user->givePermissionTo($role->permissions);

            return $this->createPersonnel($attributes, $user);
        }

        return back();
    }

    private function storeManger($attributes): _IH_User_QB|Model|Builder|User
    {
        return User::query()
            ->create([
                'name' => $attributes->input('name'),
                'email' => $attributes->input('email'),
                'institution_id' => $attributes->input('institution') ?? \Auth::user()->institution_id,
                'password' => Hash::make($attributes->input('password')),
            ]);
    }

    private function getRole($attributes): Builder|Model
    {
        return Role::query()
            ->where('id', '=', $attributes->input('role'))
            ->firstOrFail();
    }

    private function createPersonnel($attributes, $user): Builder|Model
    {
        return Personnel::query()
            ->create([
                'username' => $attributes->input('name'),
                'email' => $attributes->input('email'),
                'phones' => $attributes->input('phones'),
                'images' => self::uploadFiles($attributes),
                'gender' => $attributes->input('gender'),
                'matriculate' => $this->generateRandomTransaction(10, $attributes->input('name')),
                'academic_year_id' => $attributes->input('academic'),
                'user_id' => $user->id,
            ]);
    }

    public function updated(string $key, $attributes): Model|Builder|null
    {
        $personnel = $this->showPersonnelContent(key: $key);

        $user = User::query()
            ->whereEmail($attributes->input('email'))
            ->firstOrFail();

        $personnel->update([
            'username' => $attributes->input('name'),
            'email' => $attributes->input('email'),
            'phones' => $attributes->input('phones'),
            'gender' => $attributes->input('gender'),
            'academic_year_id' => $attributes->input('academic'),
            'user_id' => $user->id,
        ]);

        $role = $this->getRole($attributes);
        $user->syncRoles([$role->id]);
        $user->syncPermissions($role->permissions);

        return $personnel;
    }

    public function showPersonnelContent(string $key): Model|Builder|null
    {
        $personnel = Personnel::query()
            ->select([
                'id',
                'user_id',
                'username',
                'matriculate',
                'firstname',
                'lastname',
                'email',
                'phones',
                'nationality',
                'images',
                'location',
                'identityCard',
                'gender',
                'birthdays',
                'academic_year_id',
            ])
            ->where('id', '=', $key)
            ->firstOrFail();

        return $personnel->load(['user', 'academic:id,start_date,end_date']);
    }

    public function deleted(string $key): RedirectResponse
    {
        $personnel = $this->showPersonnelContent(key: $key);
        $user = User::query()
            ->where('id', '=', $personnel->user_id)
            ->first();
        $user->roles()->detach();
        $user->permissions()->detach();
        $personnel->delete();
        $user->delete();

        return back();
    }
}
