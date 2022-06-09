<?php

declare(strict_types=1);

namespace App\Repositories\Backend;

use App\Contracts\FiliaireRepositoryInterface;
use App\Enums\StatusEnum;
use App\Models\Subsidiary;
use App\Traits\ImageUploader;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\RedirectResponse;

class FiliaireRepository implements FiliaireRepositoryInterface
{
    use ImageUploader;

    public function getFiliaires(): array|Collection|\Illuminate\Support\Collection
    {
        return Subsidiary::query()
            ->with(['department', 'user', 'academic'])
            ->orderByDesc('created_at')
            ->get();
    }

    public function showFiliaire(string $key)
    {
        $filiaire = Subsidiary::query()
            ->when('key', fn ($query) => $query->where('key', $key))
            ->firstOrCreate();

        return $filiaire->load(['department', 'user']);
    }

    public function stored($attributes, $factory): Model|Builder|Subsidiary|RedirectResponse
    {
        $campus = Subsidiary::query()
            ->when('user_id', function ($query) use ($attributes) {
                $query->where('user_id', $attributes->input('user_id'));
            })
            ->orWhere('department_id', '=', $attributes->input('user'))
            ->first();
        if (! $campus) {
            $faculty = Subsidiary::query()
                ->create([
                    'department_id' => $attributes->input('department'),
                    'academic_year_id' => $attributes->input('academic'),
                    'user_id' => $attributes->input('user'),
                    'name' => $attributes->input('name'),
                    'description' => $attributes->input('description'),
                    'images' => self::uploadFiles($attributes),
                ]);
            $factory->addSuccess('Une mouvelle filiaire a ete ajouter');

            return $faculty;
        }
        $factory->addError('Le responsable choisie a ete deja affecter dans un autre campus');

        return back();
    }

    public function updated(string $key, $attributes, $factory)
    {
        $campus = $this->showFiliaire(key: $key);
        $this->removePathOfImages($campus);
        $campus->update([
            'department_id' => $attributes->input('department'),
            'user_id' => $attributes->input('user_id'),
            'name' => $attributes->input('name'),
            'description' => $attributes->input('description'),
            'images' => self::uploadFiles($attributes),
        ]);
        $factory->addSuccess('Un campus a ete modifier');

        return $campus;
    }

    public function deleted(string $key, $factory): RedirectResponse
    {
        $campus = $this->showFiliaire(key: $key);
        if ($campus->status !== StatusEnum::FALSE) {
            $factory->addError('Veillez desactiver avant de le mettre dans la corbeille');

            return back();
        }
        $campus->delete();
        $factory->addSuccess('Un campus a ete modifier');

        return back();
    }

    public function changeStatus($attributes): bool|int
    {
        $personnel = $this->showFiliaire(key: $attributes->input('key'));
        if ($personnel != null) {
            return $personnel->update([
                'status' => $attributes->input('status'),
            ]);
        }

        return false;
    }
}
