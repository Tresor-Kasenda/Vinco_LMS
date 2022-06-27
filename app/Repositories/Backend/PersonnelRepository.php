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
            ->with('user')
            ->orderByDesc('created_at')
            ->get();
    }

    public function showPersonnelContent(string $key): Model|Builder|null
    {
        $personnel = Personnel::query()
            ->where('key', '=', $key)
            ->first();

        return $personnel->load(['user', 'academic']);
    }

    public function stored($attributes, $factory): Model|Builder|RedirectResponse
    {
        $personnel = Personnel::query()
            ->where('email', '=', $attributes->input('email'))
            ->first();
        if ($personnel) {
            $factory->addError('Email deja utiliser par un autre compte');

            return back();
        }
        $user = $this->storeCampus($attributes);
        $role = $this->getRole();
        $user->assignRole($role->id);
        $personnel = $this->createPersonnel($attributes, $user);

        $factory->addSuccess('Un personnel a ete ajouter');

        return $personnel;
    }

    public function updated(string $key, $attributes, $factory): Model|Builder|null
    {
        $personnel = $this->showPersonnelContent(key: $key);

        $this->removePathOfImages(model: $personnel);

        $personnel->update([
            'username' => $attributes->input('name'),
            'lastname' => $attributes->input('lastName'),
            'email' => $attributes->input('email'),
            'phones' => $attributes->input('phones'),
            'images' => self::uploadFiles($attributes),
            'gender' => $attributes->input('gender'),
            'academic_year_id' => $attributes->input('academic'),
        ]);

        $factory->addSuccess('Personnel modifier avec succes');

        return $personnel;
    }

    public function deleted(string $key, $factory): RedirectResponse
    {
        $personnel = $this->showPersonnelContent(key: $key);
        if ($personnel->status !== StatusEnum::FALSE) {
            $factory->addError('Veillez desactiver le personnel avant de le mettre dans la corbeille');

            return back();
        }
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

    public function createPersonnel($attributes, $user): Builder|Model
    {
        return Personnel::query()
            ->create([
                'username' => $attributes->input('name'),
                'lastname' => $attributes->input('lastName'),
                'email' => $attributes->input('email'),
                'phones' => $attributes->input('phones'),
                'images' => self::uploadFiles($attributes),
                'gender' => $attributes->input('gender'),
                'academic_year_id' => $attributes->input('academic'),
                'user_id' => $user->id,
                'matriculate' => $this->generateRandomTransaction(10),
            ]);
    }

    /**
     * @param $attributes
     * @return User|Builder|Model
     */
    public function storeCampus($attributes): User|Builder|Model
    {
        return User::query()
            ->create([
                'name' => $attributes->input('name'),
                'email' => $attributes->input('email'),
                'password' => Hash::make($attributes->input('password')),
            ]);
    }

    /**
     * @return Builder|Model
     */
    public function getRole(): Builder|Model
    {
        return Role::query()
            ->where('name', '=', 'Campus')
            ->firstOrFail();
    }
}
