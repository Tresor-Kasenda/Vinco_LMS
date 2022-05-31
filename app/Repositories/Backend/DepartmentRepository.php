<?php

declare(strict_types=1);

namespace App\Repositories\Backend;

use App\Enums\StatusEnum;
use App\Contracts\DepartmentRepositoryInterface;
use App\Models\Department;
use App\Traits\ImageUploader;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\RedirectResponse;

class DepartmentRepository implements DepartmentRepositoryInterface
{
    use ImageUploader;

    public function getDepartments(): Collection|array
    {
        return Department::query()
            ->with(['campus', 'users'])
            ->latest()
            ->get();
    }

    public function showDepartment(string $key): Model|Department|Builder|null
    {
        $department = Department::query()
            ->where('key', '=', $key)
            ->first();

        return $department->load(['campus', 'users', 'professors']);
    }

    public function stored($attributes, $factory): Model|Department|Builder|RedirectResponse
    {
        $department = Department::query()
            ->when('name', function ($query) use ($attributes) {
                $query->where('name', $attributes->input('name'));
            })
            ->first();
        if (! $department) {
            $faculty = Department::query()
                ->create([
                    'name' => $attributes->input('name'),
                    'description' => $attributes->input('description'),
                    'images' => self::uploadFiles($attributes),
                    'campus_id' => $attributes->input('campus_id'),
                ]);
            $faculty->users()->attach($attributes->input('user_id'));
            $factory->addSuccess('Un nouvaux campus a ete ajouter');

            return $faculty;
        }
        $factory->addError('Le responsable choisie a ete deja affecter dans un autre campus');

        return back();
    }

    public function updated(string $key, $attributes, $factory): Model|Department|Builder|null
    {
        $department = $this->showDepartment(key: $key);
        $this->removePathOfImages($department);
        $department->users()->detach();
        $department->update([
            'name' => $attributes->input('name'),
            'description' => $attributes->input('description'),
            'images' => self::uploadFiles($attributes),
            'campus_id' => $attributes->input('campus_id'),
        ]);
        $department->users()->attach($attributes->input('user_id'));
        $factory->addSuccess('Un campus a ete modifier');

        return $department;
    }

    public function deleted(string $key, $factory): RedirectResponse
    {
        $department = $this->showDepartment(key: $key);
        if ($department->status !== StatusEnum::FALSE) {
            $factory->addError('Veillez desactiver le departement avant de le mettre dans la corbeille');

            return back();
        }
        $department->delete();
        $factory->addSuccess('Un campus a ete modifier');

        return back();
    }

    public function changeStatus($attributes): bool|int
    {
        $department = $this->showDepartment(key: $attributes->input('key'));
        if ($department != null) {
            return $department->update([
                'status' => $attributes->input('status'),
            ]);
        }

        return false;
    }
}
