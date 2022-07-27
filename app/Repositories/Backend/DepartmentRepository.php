<?php

declare(strict_types=1);

namespace App\Repositories\Backend;

use App\Contracts\DepartmentRepositoryInterface;
use App\Enums\StatusEnum;
use App\Models\Department;
use App\Models\User;
use App\Services\ToastMessageService;
use App\Traits\ImageUploader;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\RedirectResponse;

class DepartmentRepository implements DepartmentRepositoryInterface
{
    use ImageUploader;

    public function __construct(protected ToastMessageService $service)
    {
    }

    public function getDepartments(): Collection|array
    {
        if (auth()->user()->hasRole('Super Admin')) {
            return Department::query()
                ->select([
                    'id',
                    'name',
                    'campus_id',
                    'images',
                ])
                ->with([
                    'campus:id,name,institution_id',
                    'users',
                    'campus' => [
                        'institution:id,institution_name'
                    ]
                ])
                ->orderByDesc('created_at')
                ->get();
        }
         return Department::query()
            ->select([
                'id',
                'name',
                'campus_id',
                'images',
            ])
            ->with(['campus:id,name'])
            ->whereHas('campus', function ($query) {
                return $query->where('institution_id', '=', auth()->user()->institution->id);
            })
            ->orderByDesc('created_at')
            ->get();
    }

    public function showDepartment(string $key): Model|Department|Builder|null
    {
        $department = Department::query()
            ->select([
                'campus_id',
                'name',
                'id',
                'description',
                'images',
            ])
            ->where('id', '=', $key)
            ->first();

        return $department->load(['campus', 'users', 'teachers']);
    }

    public function stored($attributes): Model|Department|Builder|RedirectResponse
    {
        $department = Department::query()
            ->create([
                'name' => $attributes->input('name'),
                'description' => $attributes->input('description'),
                'images' => self::uploadFiles($attributes),
                'campus_id' => $attributes->input('campus'),
            ]);
        $department->users()->sync($attributes->input('user'));
        $this->service->success('Un nouvaux departement a ete ajouter');
        return $department;
    }

    public function updated(string $key, $attributes): Model|Department|Builder|null
    {
        $department = $this->showDepartment(key: $key);
        $department->users()->detach();
        $department->update([
            'name' => $attributes->input('name'),
            'description' => $attributes->input('description'),
            'campus_id' => $attributes->input('campus'),
        ]);
        $department->users()->sync($attributes->input('user'));
        $this->service->success('Un departement a ete modifier');

        return $department;
    }

    public function deleted(string $key): RedirectResponse
    {
        $department = $this->showDepartment(key: $key);
        if ($department->status !== StatusEnum::FALSE) {
            $this->service->warning('Veillez desactiver le departement avant de le mettre dans la corbeille');

            return back();
        }
        $department->delete();
        $this->service->success('Un department a ete supprimer');

        return back();
    }

    public function changeStatus($attributes): bool|int
    {
        $department = $this->showDepartment(key: $attributes->input('id'));

        if ($department != null) {
            return $department->update([
                'status' => $attributes->input('status'),
            ]);
        }

        return false;
    }
}
