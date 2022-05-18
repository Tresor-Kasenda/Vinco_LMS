<?php
declare(strict_types=1);

namespace App\Repositories\Backend;

use App\Interfaces\UsersRepositoryInterface;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

class UsersRepository implements UsersRepositoryInterface
{
    public function getUsers(): array|Collection
    {
        return User::query()
            ->orderByDesc('created_at')
            ->latest()
            ->get();
    }

    public function showUser(string $key)
    {
        // TODO: Implement showCourse() method.
    }

    public function stored($attributes, $flash)
    {
        // TODO: Implement stored() method.
    }

    public function updated(string $key, $attributes, $flash)
    {
        // TODO: Implement updated() method.
    }

    public function deleted(string $key, $flash)
    {
        // TODO: Implement deleted() method.
    }

    public function changeStatus($attributes)
    {
        // TODO: Implement changeStatus() method.
    }
}
