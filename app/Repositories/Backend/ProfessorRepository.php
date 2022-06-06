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
        $professor = $this->createProfessor($attributes);
        $factory->addSuccess('Un professeur a ete ajouter');

        return $professor;
    }

    public function updated(string $key, $attributes, $factory): Model|Builder|null
    {
        $professor = $this->showProfessor(key: $key);
        $this->removePathOfImages(model: $professor);
        $professor->update([
            'username' => $attributes->input('name'),
            'firstname' => $attributes->input('firstName'),
            'lastname' => $attributes->input('lastName'),
            'email' => $attributes->input('email'),
            'phones' => $attributes->input('phones'),
            'country' => $attributes->input('nationality'),
            'images' => self::uploadFiles($attributes),
            'location' => $attributes->input('address'),
            'identityCard' => $attributes->input('identityCard'),
            'gender' => $attributes->input('gender'),
            'birthdays' => $attributes->input('birthdays'),
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

    private function createProfessor($attributes): Model|Builder
    {
        return Professor::query()
            ->create([
                'username' => $attributes->input('name'),
                'firstname' => $attributes->input('firstName'),
                'lastname' => $attributes->input('lastName'),
                'email' => $attributes->input('email'),
                'phones' => $attributes->input('phones'),
                'country' => $attributes->input('nationality'),
                'images' => self::uploadFiles($attributes),
                'location' => $attributes->input('address'),
                'identityCard' => $attributes->input('identityCard'),
                'gender' => $attributes->input('gender'),
                'birthdays' => $attributes->input('birthdays'),
                'user_id' => $attributes->input('user'),
                'matriculate' => $this->generateRandomTransaction(10),
            ]);
    }
}
