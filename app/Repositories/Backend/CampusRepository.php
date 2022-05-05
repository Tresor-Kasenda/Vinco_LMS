<?php
declare(strict_types=1);

namespace App\Repositories\Backend;

use App\Enums\StatusEnum;
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
use Illuminate\Support\Facades\Response;

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
            ->where('key', '=', $key)
            ->first();
        return $campus->load(['user', 'departments']);
    }

    public function stored($attributes, $factory): Model|Builder|RedirectResponse
    {
        $campus = Campus::query()
            ->when('user_id', function ($query) use ($attributes){
                $query->where('user_id', $attributes->input('user_id'));
            })
            ->first();
        if ($campus->exists()) {
            $factory->addError("Le responsable choisie a ete deja affecter dans un autre campus");
            return back();
        }
        $campus = Campus::query()
            ->create([
                'user_id' => $attributes->input('user_id'),
                'name' => $attributes->input('name'),
                'description' => $attributes->input('description'),
                'images' => self::uploadFiles($attributes)
            ]);
        $factory->addSuccess('Un nouvaux campus a ete ajouter');
        return $campus;
    }

    public function updated(string $key, $attributes, $factory): Model|Builder|null
    {
        $campus = $this->showCampus(key: $key);
        $this->removePathOfImages($campus);
        $campus->update([
            'user_id' => $attributes->input('user_id'),
            'name' => $attributes->input('name'),
            'description' => $attributes->input('description'),
            'images' => self::uploadFiles($attributes)
        ]);
        $factory->addSuccess('Un campus a ete modifier');
        return $campus;
    }

    public function deleted(string $key, $factory): RedirectResponse
    {
        $campus = $this->showCampus(key: $key);
        if ($campus->status !== StatusEnum::FALSE){
            $factory->addError("Veillez desactiver le campus avant de le mettre dans la corbeille");
            return back();
        }
        $campus->delete();
        $factory->addSuccess('Un campus a ete modifier');
        return back();
    }
}
