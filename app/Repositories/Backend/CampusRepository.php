<?php

declare(strict_types=1);

namespace App\Repositories\Backend;

use App\Contracts\CampusRepositoryInterface;
use App\Enums\StatusEnum;
use App\Models\Campus;
use App\Traits\ImageUploader;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\RedirectResponse;

class CampusRepository implements CampusRepositoryInterface
{
    use ImageUploader;

    public function getCampuses(): Collection|array
    {
        return Campus::query()
            ->select([
                'id',
                'name',
                'images',
                'institution_id',
                'user_id'
            ])
            ->with(['institution', 'user'])
            ->get();
    }

    public function showCampus(string $key): Model|Builder|null
    {
        $campus = Campus::query()
            ->where('id', '=', $key)
            ->first();

        return $campus->load(['user', 'institution', 'departments']);
    }

    public function stored($attributes, $factory): Model|Builder|RedirectResponse
    {
        $campus = Campus::query()
            ->where('user_id', '=', $attributes->input('personnel'))
            ->orWhere('name', '=', $attributes->input("name"))
            ->first();

        if (! $campus) {
            $faculty = Campus::query()
                ->create([
                    'user_id' => $attributes->input('personnel'),
                    'name' => $attributes->input('name'),
                    'description' => $attributes->input('description'),
                    'images' => self::uploadFiles($attributes),
                    'institution_id' => $attributes->input('institution')
                ]);
            $factory->addSuccess('Campus add with successfully');

            return $faculty;
        }
        $factory->addError('Le responsable choisie a ete deja affecter dans un autre campus');

        return back();
    }

    public function updated(string $key, $attributes, $factory): Model|Builder|null
    {
        $campus = $this->showCampus(key: $key);
        $this->removePathOfImages($campus);
        $campus->update([
            'user_id' => $attributes->input('user_id'),
            'name' => $attributes->input('name'),
            'description' => $attributes->input('description'),
            'institution_id' => $attributes->input('institution')
        ]);
        $factory->addSuccess('Un campus a ete modifier');

        return $campus;
    }

    public function deleted(string $key, $factory): RedirectResponse
    {
        $campus = $this->showCampus(key: $key);
        if ($campus->status !== StatusEnum::FALSE) {
            $factory->addError('Veillez desactiver le campus avant de le mettre dans la corbeille');

            return back();
        }
        $campus->delete();
        $factory->addSuccess('Un campus a ete modifier');

        return back();
    }

    public function changeStatus($attributes): bool|int
    {
        $personnel = $this->showCampus(key: $attributes->input('id'));
        if ($personnel != null) {
            return $personnel->update([
                'status' => $attributes->input('status'),
            ]);
        }

        return false;
    }
}
