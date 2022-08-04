<?php

declare(strict_types=1);

namespace App\Repositories\Backend;

use App\Contracts\CampusRepositoryInterface;
use App\Enums\StatusEnum;
use App\Models\Campus;
use App\Services\ToastMessageService;
use App\Traits\ImageUploader;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\RedirectResponse;

class CampusRepository implements CampusRepositoryInterface
{
    use ImageUploader;

    public function __construct(protected ToastMessageService $service)
    {
    }

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

    public function stored($attributes): Model|Builder|RedirectResponse
    {
        $faculty = Campus::query()
            ->create([
                'user_id' => $attributes->input('personnel'),
                'name' => $attributes->input('name'),
                'description' => $attributes->input('description'),
                'images' => self::uploadFiles($attributes),
                'institution_id' => $attributes->input('institution') ?? auth()->user()->institution->id,
            ]);
        $this->service->success('Campus add with successfully');

        return $faculty;
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
        $this->service->success('Un campus a ete modifier');

        return $campus;
    }

    public function deleted(string $key): RedirectResponse
    {
        $campus = $this->showCampus(key: $key);
        if ($campus->status !== StatusEnum::FALSE) {
            $this->service->warning('Veillez desactiver le campus avant de le mettre dans la corbeille');

            return back();
        }
        $campus->delete();
        $this->service->success('Un campus a ete supprimer');

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
