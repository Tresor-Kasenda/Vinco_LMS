<?php

declare(strict_types=1);

namespace App\Repositories\Backend;

use App\Contracts\ParentRepositoryInterface;
use App\Models\Guardian;
use App\Models\User;
use App\Traits\ImageUploader;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
use function PHPUnit\Framework\assertTrue;
use function PHPUnit\Framework\at;
use Spatie\Permission\Models\Role;

class ParentRepository implements ParentRepositoryInterface
{
    use ImageUploader;

    public function guardians(): Collection|array
    {
        return Guardian::query()
            ->orderByDesc('created_at')
            ->get();
    }

    public function showGuardian(string $key): Model|Guardian|Builder
    {
        return Guardian::query()
            ->where('id', '=', $key)
            ->firstOrFail();
    }

    public function stored($attributes, $factory): Model|Guardian|Builder
    {
        $parent = $this->createUserParent($attributes);
        $role = $this->getParentRole();
        $parent->assignRole($role);

        $guardian = Guardian::query()
            ->create([
                'name_guardian' => $attributes->input('name'),
                'email_guardian' => $attributes->input('email'),
                'phones' => $attributes->input('phones'),
                'gender' => $attributes->input('gender'),
                'user_id' => $parent->id,
            ]);

        $factory->addSuccess('Parent added with successfully');

        return $guardian;
    }

    public function updated(string $key, $attributes, $factory): Model|Guardian|Builder
    {
        $parent = $this->showGuardian($key);
        $this->removePathOfImages($parent);

        $parent->update([
            'name_guardian' => $attributes->input('name'),
            'email_guardian' => $attributes->input('email'),
            'phones' => $attributes->input('phones'),
            'gender' => $attributes->input('gender'),
        ]);

        $factory->addSuccess('Parent updated with successfully');

        return $parent;
    }

    public function deleted(string $key, $factory): Model|Guardian|Builder
    {
        $parent = $this->showGuardian($key);

        $parent->delete();

        $factory->addSuccess('Parent deleted with successfully');

        return $parent;
    }

    public function changeStatus($attributes)
    {
        // TODO: Implement changeStatus() method.
    }

    /**
     * @param $attributes
     * @return User|Builder|Model
     */
    public function createUserParent($attributes): User|Builder|Model
    {
        return User::query()
            ->create([
                'name' => $attributes->input('name'),
                'email' => $attributes->input('email'),
                'password' => Hash::make($attributes->input('password')),
            ]);
    }

    /**
     * @return Builder|Model
     */
    public function getParentRole(): Builder|Model
    {
        return Role::query()
            ->where('name', '=', 'Parent')
            ->firstOrFail();
    }
}
