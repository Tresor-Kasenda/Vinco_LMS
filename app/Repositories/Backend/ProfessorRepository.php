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
use LaravelIdea\Helper\App\Models\_IH_User_QB;
use Spatie\Permission\Models\Role;

class ProfessorRepository implements ProfessorRepositoryInterface
{
    use ImageUploader, RandomValues;

    public function getProfessors(): Collection|array
    {
        return Professor::query()
            ->select([
                'id',
                'images',
                'username',
                'email',
                'phones',
                'matriculate',
            ])
            ->with(['departments'])
            ->latest()
            ->get();
    }

    public function showProfessor(string $key): Model|Builder|null
    {
        $professor = Professor::query()
            ->whereId($key)
            ->first();

        return $professor->load(['user', 'courses:id,name']);
    }

    public function stored($attributes, $factory): Model|Builder|RedirectResponse
    {
        $professor = Professor::query()
            ->where('email', '=', $attributes->input('email'))
            ->first();

        if (! $professor) {
            $user = $this->createUser($attributes);
            if ($user != null) {
                $role = $this->getRole();
                $user->assignRole($role->id);
                $professor = $this->createProfessor($attributes, $user);
                $factory->addSuccess('Un professeur a ete ajouter');

                return $professor;
            }
            $factory->addError('Utilisateur existe avec l\'addresse email choisie');

            return back();
        }
        $factory->addError('Email deja utiliser par un autre compte');

        return back();
    }

    public function updated(string $key, $attributes, $factory): Model|Builder|null
    {
        $professor = $this->showProfessor(key: $key);
        $professor->update([
            'username' => $attributes->input('name'),
            'lastname' => $attributes->input('lastname'),
            'email' => $attributes->input('email'),
            'phones' => $attributes->input('phones'),
            'gender' => $attributes->input('gender'),
        ]);

        $factory->addSuccess('Une modification a ete effectuer');

        return $professor;
    }

    public function deleted(string $key, $factory): RedirectResponse
    {
        $professor = $this->showProfessor(key: $key);
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
                'matriculate' => $this->generateRandomTransaction(10, $attributes->input('name')),
            ]);
    }

    public function createUser($attributes): _IH_User_QB|Model|Builder|User|RedirectResponse|null
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

        return null;
    }

    /**
     * @return Builder|Model
     */
    public function getRole(): Builder|Model
    {
        return Role::query()
            ->whereName('Professeur')
            ->firstOrFail();
    }
}
