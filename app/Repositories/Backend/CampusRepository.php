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

final class CampusRepository implements CampusRepositoryInterface
{
    use ImageUploader;

    public function getCampuses(): Collection|array
    {
        if (auth()->user()->hasRole('Super Admin')) {
            return Campus::query()
                ->select([
                    'id',
                    'name',
                    'images',
                    'institution_id',
                    'user_id',
                ])
                ->with(['institution:id,institution_name', 'user:id,name,email'])
                ->get();
        }

        return Campus::query()
            ->select([
                'id',
                'name',
                'images',
                'institution_id',
                'user_id',
            ])
            ->where('institution_id', '=', auth()->user()->institution_id)
            ->with(['institution:id,institution_name', 'user:id,name,email'])
            ->get();
    }

    public function stored($attributes): Model|Builder|RedirectResponse
    {
        return Campus::query()
            ->create([
                'user_id' => $attributes->input('personnel'),
                'name' => $attributes->input('name'),
                'description' => $attributes->input('description'),
                'images' => self::uploadFiles($attributes),
                'institution_id' => $attributes->input('institution') ?? auth()->user()->institution->id,
            ]);
    }

    public function updated(string $key, $attributes): Model|Builder|null
    {
        $campus = $this->showCampus(key: $key);
        $this->removePathOfImages($campus);
        $campus->update([
            'user_id' => $attributes->input('personnel'),
            'name' => $attributes->input('name'),
            'description' => $attributes->input('description'),
            'institution_id' => $attributes->input('institution') ?? \Auth::user()->institution->id,
            'images' => self::uploadFiles($attributes),
        ]);

        return $campus;
    }

    public function showCampus(string $key): Model|Builder|null
    {
        $campus = Campus::query()
            ->select([
                'id',
                'name',
                'images',
                'institution_id',
                'user_id',
            ])
            ->where('id', '=', $key)
            ->first();

        return $campus->load(['user', 'institution', 'departments']);
    }

    public function deleted(string $key): RedirectResponse
    {
        $campus = $this->showCampus(key: $key);
//        if ($campus->status !== StatusEnum::FALSE) {
//            return back();
//        }
        $campus->delete();

        return back();
    }
}
