<?php
declare(strict_types=1);

namespace App\Repositories\Backend;

use App\Interfaces\PersonnelRepositoryInterface;
use App\Models\Personnel;
use Illuminate\Database\Eloquent\Collection;

class PersonnelRepository implements PersonnelRepositoryInterface
{

    public function getPersonnelContent(): Collection|array
    {
        return Personnel::query()
            ->with('user')
            ->orderByDesc('created_at')
            ->get();
    }

    public function showPersonnelContent(string $key)
    {
        // TODO: Implement showPersonnelContent() method.
    }

    public function stored($attributes)
    {
        // TODO: Implement stored() method.
    }

    public function edited(string $key)
    {
        // TODO: Implement edited() method.
    }

    public function updated(string $key, $attributes)
    {
        // TODO: Implement updated() method.
    }

    public function deleted(string $key)
    {
        // TODO: Implement deleted() method.
    }
}
