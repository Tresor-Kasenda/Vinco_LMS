<?php

declare(strict_types=1);

namespace App\Repositories\Backend;

use App\Contracts\DepartmentRepositoryInterface;
use App\Enums\StatusEnum;
use App\Models\Department;
use App\Traits\ImageUploader;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\RedirectResponse;

final class DepartmentRepository implements DepartmentRepositoryInterface
{
    use ImageUploader;

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
                        'institution:id,institution_name',
                    ],
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
            ->whereHas('campus', fn ($query) => $query->where('institution_id', '=', auth()->user()->institution->id))
            ->orderByDesc('created_at')
            ->get();
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

        return $department;
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

    public function deleted(string $key): RedirectResponse
    {
        $department = $this->showDepartment(key: $key);
        if ($department->status !== StatusEnum::FALSE) {
            return back();
        }
        $department->delete();

        return back();
    }
}
