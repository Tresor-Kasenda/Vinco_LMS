<?php
declare(strict_types=1);

namespace App\Repositories\Backend;

use App\Interfaces\CampusRepositoryInterface;
use App\Interfaces\PersonnelRepositoryInterface;
use App\Interfaces\ProfessorRepositoryInterface;
use App\Models\Campus;
use App\Models\Personnel;
use App\Models\Professor;
use App\Models\User;
use App\Traits\ImageUploader;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Hash;

class CampusRepository implements CampusRepositoryInterface
{
    use ImageUploader;

    public function getCampuses(): Collection|array
    {
        return Campus::query()
            ->with('user')
            ->latest()
            ->get();
    }

    public function showCampus(string $key): Model|Builder|null
    {
        $campus = Campus::query()
            ->where('id', '=', $key)
            ->first();
        return $campus->load(['user', 'departments']);
    }

    public function stored($attributes, $factory)
    {

    }

    public function updated(string $key, $attributes, $factory)
    {
        // TODO: Implement updated() method.
    }

    public function deleted(string $key, $factory)
    {
        // TODO: Implement deleted() method.
    }
}
