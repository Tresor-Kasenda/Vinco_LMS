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
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Hash;
use LaravelIdea\Helper\App\Models\_IH_Guardian_QB;
use LaravelIdea\Helper\App\Models\_IH_User_QB;
use function PHPUnit\Framework\assertTrue;
use function PHPUnit\Framework\at;
use Spatie\Permission\Models\Role;

class ParentRepository implements ParentRepositoryInterface
{
    use ImageUploader;

    public function guardians(): Collection|array
    {
        return Guardian::query()
            ->select([
                'id',
                'name_guardian',
                'email_guardian',
                'images',
                'phones'
            ])
            ->orderByDesc('created_at')
            ->get();
    }

    public function showGuardian(string $key): Model|Guardian|Builder
    {
        $parent = Guardian::query()
            ->whereId($key)
            ->firstOrFail();

        return $parent->load(['user', 'students']);
    }

    public function stored($attributes, $factory): Model|_IH_Guardian_QB|Guardian|Builder|RedirectResponse
    {
        $parent = Guardian::query()
            ->where('email_guardian', '=', $attributes->input('email'))
            ->exists();

        if (!$parent) {
            $user = $this->createParent($attributes);
            if ($user != null) {
                $role = $this->getParentRole();
                $user->assignRole($role);
                $guardian = Guardian::query()
                    ->create([
                        'name_guardian' => $attributes->input('name'),
                        'email_guardian' => $attributes->input('email'),
                        'phones' => $attributes->input('phones'),
                        'gender' => $attributes->input('gender'),
                        'images' => self::uploadFiles($attributes),
                        'user_id' => $user->id,
                    ]);
                $factory->addSuccess('Parent added with successfully');
                return $guardian;
            }
            $factory->addError('Utilisateur existe avec l\'addresse email choisie');
            return back();
        }
        $factory->addError('Email deja utiliser par un autre compte');
        return back();
    }

    public function updated(string $key, $attributes, $factory): Model|Guardian|Builder
    {
        $parent = $this->showGuardian($key);

        $parent->update([
            'name_guardian' => $attributes->input('name'),
            'email_guardian' => $attributes->input('email'),
            'phones' => $attributes->input('phones'),
            'gender' => $attributes->input('gender'),
        ]);

        $factory->addSuccess("Parent updated with successfully");

        return $parent;
    }

    public function deleted(string $key, $factory): Model|Guardian|Builder
    {
        $parent = $this->showGuardian($key);

        $parent->delete();

        $factory->addSuccess("Parent deleted with successfully");

        return $parent;
    }

    public function createParent($attributes): _IH_User_QB|Model|Builder|User|null
    {
        $user = User::query()
            ->where('email', '=', $attributes->input('email'))
            ->first();
        if (!$user) {
            return User::query()
                ->create([
                    'name' => $attributes->input('name'),
                    'email' => $attributes->input('email'),
                    'password' => Hash::make($attributes->input('password')),
                ]);
        }
        return null;
    }

    /**
     * @return Builder|Model
     */
    public function getParentRole(): Builder|Model
    {
        return Role::query()
            ->whereName('Parent')
            ->firstOrFail();
    }
}
