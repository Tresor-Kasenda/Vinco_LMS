<?php

declare(strict_types=1);

namespace App\Repositories\Backend;

use App\Contracts\PersonnelRepositoryInterface;
use App\Enums\StatusEnum;
use App\Models\Personnel;
use App\Models\User;
use App\Traits\ImageUploader;
use App\Traits\RandomValues;
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
    use ImageUploader, RandomValues;

    public function getPersonnelContent(): Collection|array
    {
        return Personnel::query()
            ->select([
                'images_personnel',
                'matriculate',
                'gender',
                'username',
                'id',
                'phones',
                'email',
            ])
            ->with('user')
            ->orderByDesc('created_at')
            ->get();
    }

    public function showPersonnelContent(string $key): Model|Builder|null
    {
        $personnel = Personnel::query()
            ->where('id', '=', $key)
            ->firstOrFail();

        return $personnel->load(['user', 'academic']);
    }

    public function stored($attributes, $factory): Model|Builder|RedirectResponse
    {
        $personnel = Personnel::query()
            ->where('email', '=', $attributes->input('email'))
            ->first();
        if (! $personnel) {
            $user = $this->storeCampus($attributes);
            $role = $this->getRole($attributes);
            $user->assignRole($role->id);
            $personnel = $this->createPersonnel($attributes, $user);

            $factory->addSuccess('Un personnel a ete ajouter');

            return $personnel;
        }
        $factory->addError('Email deja utiliser par un autre compte');

        return back();
    }

    public function updated(string $key, $attributes, $factory): Model|Builder|null
    {
        $personnel = $this->showPersonnelContent(key: $key);

        $personnel->update([
            'username' => $attributes->input('name'),
            'email' => $attributes->input('email'),
            'phones' => $attributes->input('phones'),
            'gender' => $attributes->input('gender'),
            'academic_year_id' => $attributes->input('academic'),
        ]);

        $user = User::query()
            ->whereEmail($attributes->input('email'))
            ->firstOrFail();

        $user->syncRoles($attributes->input('role'));

        $factory->addSuccess('Personnel modifier avec succes');

        return $personnel;
    }

    public function deleted(string $key, $factory): RedirectResponse
    {
        $personnel = $this->showPersonnelContent(key: $key);
        $personnel->delete();
        $factory->addSuccess('Personnel modifier avec succes');

        return back();
    }

    public function changeStatus($attributes): bool|int
    {
        $personnel = $this->showPersonnelContent(key: $attributes->input('key'));
        if ($personnel != null) {
            return $personnel->update([
                'status' => $attributes->input('status'),
            ]);
        }

        return false;
    }

    private function createPersonnel($attributes, $user): Builder|Model
    {
        return Personnel::query()
            ->create([
                'username' => $attributes->input('name'),
                'email' => $attributes->input('email'),
                'phones' => $attributes->input('phones'),
                'images_personnel' => self::uploadFiles($attributes),
                'gender' => $attributes->input('gender'),
                'academic_year_id' => $attributes->input('academic'),
                'user_id' => $user->id,
                'matriculate' => $this->generateRandomTransaction(10, $attributes->input('name')),
            ]);
    }

    public function storeCampus($attributes): _IH_User_QB|Model|Builder|User|RedirectResponse
    {
        $user = User::query()
            ->where('email', '=', $attributes->input('email'))
            ->first();
        if (! $user) {
            return User::query()
                ->create([
                    'name' => $attributes->input('name'),
                    'email' => $attributes->input('email'),
                    'password' => Hash::make($attributes->input('password')),
                ]);
        }

        return back();
    }

    public function getRole($attributes): Builder|Model
    {
        return Role::query()
            ->where('id', '=', $attributes->input('role'))
            ->firstOrFail();
    }
}
