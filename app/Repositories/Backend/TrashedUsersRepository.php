<?php

 declare(strict_types=1);

namespace App\Repositories\Backend;

use App\Contracts\TrashedUsersRepositoryInterface;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\RedirectResponse;

class TrashedUsersRepository implements TrashedUsersRepositoryInterface
{
    public function getTrashes(): array|Collection
    {
        return User::onlyTrashed()
            ->orderByDesc('created_at', 'desc')
            ->get();
    }

    public function restore(string $key, $alert)
    {
        $campus = $this->getTrashedCampus($key);
        $campus->restore();
        $alert->addSuccess("L'utilisateur a ete restorer avec success");

        return $campus;
    }

    public function deleted(string $key, $alert): RedirectResponse
    {
        $campus = $this->getTrashedCampus($key);
        $campus->forceDelete();
        $alert->addInfo('Utilisateur supprimer definivement avec succes');

        return back();
    }

    public function getTrashedCampus(string $key): mixed
    {
        return User::withTrashed()
            ->when('key', function ($query) use ($key) {
                $query->where('key', $key);
            })
            ->first();
    }
}
