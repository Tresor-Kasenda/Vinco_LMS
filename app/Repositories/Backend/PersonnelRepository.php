<?php

declare(strict_types=1);

namespace App\Repositories\Backend;

use App\Enums\StatusEnum;
use App\Interfaces\PersonnelRepositoryInterface;
use App\Models\Personnel;
use App\Models\User;
use App\Traits\ImageUploader;
use App\Traits\RandomValues;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Hash;

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
        $personnel = $this->createPersonnel($attributes);
        $factory->addSuccess('Un personnel a ete ajouter');

        return $personnel;
    }

    public function updated(string $key, $attributes, $factory): Model|Builder|null
    {
        $personnel = $this->showPersonnelContent(key: $key);
        $personnel->update([
            'username' => $attributes->input('name'),
            'firstname' => $attributes->input('firstName'),
            'lastname' => $attributes->input('lastName'),
            'email' => $attributes->input('email'),
            'phones' => $attributes->input('phones'),
            'nationality' => $attributes->input('nationality'),
            'location' => $attributes->input('address'),
            'identityCard' => $attributes->input('identityCard'),
            'gender' => $attributes->input('gender'),
            'birthdays' => $attributes->input('birthdays'),
            'academic_year_id' => $attributes->input('academic'),
            'user_id' => $attributes->input('user'),
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

    public function createPersonnel($attributes): Builder|Model
    {
        return Personnel::query()
            ->create([
                'username' => $attributes->input('name'),
                'firstname' => $attributes->input('firstName'),
                'lastname' => $attributes->input('lastName'),
                'email' => $attributes->input('email'),
                'phones' => $attributes->input('phones'),
                'nationality' => $attributes->input('nationality'),
                'images' => self::uploadFiles($attributes),
                'location' => $attributes->input('address'),
                'identityCard' => $attributes->input('identityCard'),
                'gender' => $attributes->input('gender'),
                'birthdays' => $attributes->input('birthdays'),
                'academic_year_id' => $attributes->input('academic'),
                'user_id' => $attributes->input('user'),
                'matriculate' => $this->generateRandomTransaction(10),
            ]);
    }
}
