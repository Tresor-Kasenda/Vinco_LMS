<?php

declare(strict_types=1);

namespace App\Repositories\Backend;

use App\Contracts\ProfessorRepositoryInterface;
use App\Enums\RoleEnum;
use App\Enums\StatusEnum;
use App\Models\Professor;
use App\Models\User;
use App\Traits\ImageUploader;
use App\Traits\RandomValues;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class ProfessorRepository implements ProfessorRepositoryInterface
{
    use ImageUploader, RandomValues;

    public function getProfessors(): Collection|array
    {
        return Professor::query()
            ->with(['department', 'user'])
            ->latest()
            ->get();
    }

    public function showProfessor(string $key): Model|Builder|null
    {
        $professor = Professor::query()
            ->where('key', '=', $key)
            ->first();

        return $professor->load(['user']);
    }

    public function stored($attributes, $factory): Model|Builder|RedirectResponse
    {
        $professor = Professor::query()
            ->where('email', '=', $attributes->input('email'))
            ->first();
        if ($professor) {
            $factory->addError('Email deja utiliser par un autre compte');

            return back();
        }
        $user = $this->createUser($attributes);
        $role = $this->getRole();
        $user->assignRole($role->id);

        $professor = $this->createProfessor($attributes, $user);

        $factory->addSuccess('Un professeur a ete ajouter');

        return $professor;
    }

    public function updated(string $key, $attributes, $factory): Model|Builder|null
    {
        $professor = $this->showProfessor(key: $key);
        $this->removePathOfImages(model: $professor);
        $professor->update([
            'username' => $attributes->input('name'),
            'lastname' => $attributes->input('lastname'),
            'email' => $attributes->input('email'),
            'phones' => $attributes->input('phones'),
            'images' => self::uploadFiles($attributes),
            'gender' => $attributes->input('gender'),
        ]);
        $factory->addSuccess('Une modification a ete effectuer');

        return $professor;
    }

    public function deleted(string $key, $factory): RedirectResponse
    {
        $professor = $this->showProfessor(key: $key);
        if ($professor->status !== StatusEnum::FALSE) {
            $factory->addError('Veillez desactiver le professeur avant de le mettre dans la corbeille');

            return back();
        }
        $professor->delete();
        $factory->addSuccess('Un Professeur a ete ajouter  dans la corbeille');

        return back();
    }

    public function changeStatus($attributes): bool|int
    {
        $professor = $this->showProfessor(key: $attributes->input('key'));
        if ($professor != null) {
            return $professor->update([
                'status' => $attributes->input('status'),
            ]);
        }

        return false;
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

    /**
     * @param $attributes
     * @return User|Builder|Model
     */
    public function createUser($attributes): User|Builder|Model
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
            ->where('name', '=', 'Teacher')
            ->firstOrFail();
    }
}
