<?php

declare(strict_types=1);

namespace App\Repositories\Backend;

use App\Contracts\FiliaireRepositoryInterface;
use App\Models\Subsidiary;
use App\Traits\ImageUploader;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\RedirectResponse;
use LaravelIdea\Helper\App\Models\_IH_Subsidiary_QB;

final class FiliaireRepository implements FiliaireRepositoryInterface
{
    use ImageUploader;

    public function getFiliaires(): array|Collection|\Illuminate\Support\Collection
    {
        if (auth()->user()->hasRole('Super Admin')) {
            return Subsidiary::query()
                ->select([
                    'id',
                    'name',
                    'description',
                    'user_id',
                    'images',
                    'department_id',
                ])
                ->with([
                    'department:id,name,campus_id',
                    'user:id,name',
                    'department' => [
                        'campus:id,institution_id' => [
                            'institution:id,institution_name',
                        ],
                    ],
                ])
                ->orderByDesc('created_at')
                ->get();
        }

        return Subsidiary::query()
            ->select([
                'id',
                'name',
                'description',
                'user_id',
                'images',
                'department_id',
            ])
            ->whereHas('user', function ($builder) {
                $builder->where('institution_id', auth()->user()->institution->id);
            })
            ->whereHas('department', function ($builder) {
                $builder->with('campus', function ($query) use ($builder) {
                    $query->where('id', $builder->where('id', 'departent_id'));
                });
            })
            ->with(['department:id,name', 'user:id,name'])
            ->orderByDesc('created_at')
            ->get();
    }

    public function stored($attributes): Model|Builder|Subsidiary|RedirectResponse
    {
        return Subsidiary::query()
            ->create([
                'department_id' => $attributes->input('department'),
                'user_id' => $attributes->input('user'),
                'name' => $attributes->input('name'),
                'description' => $attributes->input('description'),
                'images' => self::uploadFiles($attributes),
            ]);
    }

    public function updated(string $key, $attributes): Model|Builder|Subsidiary|_IH_Subsidiary_QB
    {
        $campus = $this->showFiliaire(key: $key);

        $campus->update([
            'department_id' => $attributes->input('department'),
            'user_id' => $attributes->input('user'),
            'name' => $attributes->input('name'),
            'description' => $attributes->input('description'),
        ]);

        return $campus;
    }

    public function showFiliaire(string $key): Model|Builder|Subsidiary|_IH_Subsidiary_QB
    {
        $filiaire = Subsidiary::query()
            ->select([
                'id',
                'name',
                'description',
                'user_id',
                'images',
                'department_id',
            ])
            ->where('id', '=', $key)
            ->firstOrCreate();

        return $filiaire->load(['department', 'user', 'department.campus:id,name']);
    }

    public function deleted(string $key): RedirectResponse
    {
        $campus = $this->showFiliaire(key: $key);
        $campus->delete();

        return back();
    }
}
