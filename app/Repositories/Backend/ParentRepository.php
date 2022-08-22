<?php

declare(strict_types=1);

namespace App\Repositories\Backend;

use App\Contracts\ParentRepositoryInterface;
use App\Models\Guardian;
use App\Models\Role;
use App\Models\User;
use App\Services\ToastMessageService;
use App\Traits\ImageUploader;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Hash;

final class ParentRepository implements ParentRepositoryInterface
{
    use ImageUploader;

    public function __construct(protected ToastMessageService $service)
    {
    }

    public function guardians(): Collection|array
    {
        if (auth()->user()->hasRole('Super Admin')) {
            return Guardian::query()
                ->select([
                    'id',
                    'name_guardian',
                    'email_guardian',
                    'images',
                    'phones',
                ])
                ->orderByDesc('created_at')
                ->get();
        }

        return Guardian::query()
            ->select([
                'id',
                'name_guardian',
                'email_guardian',
                'images',
                'phones',
                'user_id',
            ])
            ->whereHas('user', fn ($query) => $query->where('institution_id', '=', auth()->user()->institution_id))
            ->orderByDesc('created_at')
            ->get();
    }

    public function stored($attributes): Model|Guardian|Builder|RedirectResponse
    {
        $user = $this->createParent($attributes);
        if ($user != null) {
            $role = $this->getParentRole();
            $user->attachRole($role);
            $guardian = Guardian::query()
                ->create([
                    'name_guardian' => $attributes->input('name'),
                    'email_guardian' => $attributes->input('email'),
                    'phones' => $attributes->input('phones'),
                    'gender' => $attributes->input('gender'),
                    'images' => self::uploadFiles($attributes),
                    'user_id' => $user->id,
                ]);
            $this->service->success('Parent added with successfully');

            return $guardian;
        }
    }

    private function createParent($attributes): Model|Builder|User|null
    {
        $user = User::query()
            ->where('email', '=', $attributes->input('email'))
            ->first();
        if (! $user) {
            return User::query()
                ->create([
                    'name' => $attributes->input('name'),
                    'email' => $attributes->input('email'),
                    'institution_id' => \Auth::user()->institution_id,
                    'password' => Hash::make($attributes->input('password')),
                ]);
        }

        return null;
    }

    private function getParentRole(): Builder|Model
    {
        return Role::query()
            ->where('name', '=', 'Parent')
            ->firstOrFail();
    }

    public function updated(string $key, $attributes): Model|Guardian|Builder
    {
        $parent = $this->showGuardian($key);

        $parent->update([
            'name_guardian' => $attributes->input('name'),
            'email_guardian' => $attributes->input('email'),
            'phones' => $attributes->input('phones'),
            'gender' => $attributes->input('gender'),
        ]);

        $this->service->success('Parent updated with successfully');

        return $parent;
    }

    public function showGuardian(string $key): Model|Guardian|Builder
    {
        $parent = Guardian::query()
            ->select([
                'id',
                'user_id',
                'name_guardian',
                'firstName_guardian',
                'email_guardian',
                'images',
                'phones',
                'occupation',
            ])
            ->whereId($key)
            ->firstOrFail();

        return $parent->load(['user', 'students']);
    }

    public function deleted(string $key): Model|Guardian|Builder
    {
        $parent = $this->showGuardian($key);
        $parent->delete();
        $this->service->success('Parent deleted with successfully');

        return $parent;
    }
}
