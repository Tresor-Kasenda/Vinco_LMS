<?php

declare(strict_types=1);

namespace App\Repositories\Backend;

use App\Contracts\ProfessorRepositoryInterface;
use App\Models\Professor;
use App\Models\Role;
use App\Models\User;
use App\Services\ToastMessageService;
use App\Traits\ImageUploader;
use App\Traits\RandomValues;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Hash;
use LaravelIdea\Helper\App\Models\_IH_User_QB;

class ProfessorRepository implements ProfessorRepositoryInterface
{
    use ImageUploader, RandomValues;

    public function __construct(protected ToastMessageService $service)
    {
    }

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
        } else {
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
                ->whereHas('user', fn ($query) => $query->where('institution_id', '=', auth()->user()->institution_id))
                ->orderByDesc('created_at')
                ->get();
        }
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
            ])
            ->whereId($key)
            ->first();

        return $professor->load(['courses:id,name', 'user']);
    }

    public function stored($attributes): Model|Builder|RedirectResponse
    {
        $user = $this->createUser($attributes);
        $role = $this->getRole();
        $user->attachRole($role->id);

        $professor = $this->createProfessor($attributes, $user);
        $this->service->success('Un professeur a ete ajouter');

        return $professor;
    }

    public function updated(string $key, $attributes): Model|Builder|null
    {
        $professor = $this->showProfessor(key: $key);
        $professor->update([
            'username' => $attributes->input('name'),
            'lastname' => $attributes->input('lastname'),
            'email' => $attributes->input('email'),
            'phones' => $attributes->input('phones'),
            'gender' => $attributes->input('gender'),
        ]);

        $this->service->success('Une modification a ete effectuer');

        return $professor;
    }

    public function deleted(string $key): RedirectResponse
    {
        $professor = $this->showProfessor(key: $key);
        $professor->delete();
        $this->service->success('Un Professeur a ete ajouter  dans la corbeille');

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

        $this->service->error('Email deja utiliser sur un autre compte');

        return null;
    }

    private function getRole(): Builder|Model
    {
        return Role::query()
            ->whereName('Professeur')
            ->firstOrFail();
    }
}
