<?php
declare(strict_types=1);

namespace App\Repositories\Backend;

use App\Interfaces\PersonnelRepositoryInterface;
use App\Interfaces\ProfessorRepositoryInterface;
use App\Models\Personnel;
use App\Models\Professor;
use App\Models\User;
use App\Traits\ImageUploader;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Hash;

class ProfessorRepository implements ProfessorRepositoryInterface
{
    use ImageUploader;

    public function getProfessors(): Collection|array
    {
        return Professor::query()
            ->with(['department', 'user'])
            ->latest()
            ->get();
    }

    public function showProfessor(string $key): Model|Builder|null
    {
        $professor = Professor::query()
            ->where('id', '=', $key)
            ->first();
        return $professor->load(['user', 'department']);
    }

    public function stored($attributes, $factory): Model|Builder|RedirectResponse
    {
        $user = User::query()
            ->where('email', '=', $attributes->input('personnelEmail'))
            ->first();
        if ($user) {
            $factory->addError("Email deja utiliser par un autre compte");
            return back();
        }
        $user = User::query()
            ->create([
                'name' => $attributes->input('name'),
                'firstName' => $attributes->input('firstname'),
                'email' => $attributes->input('personnelEmail'),
                'password' => Hash::make($attributes->input('identityCard')),
                'role_id' => $attributes->input('role_id'),
            ]);
        $professor = $this->createProfessor($attributes, $user);
        $factory->addSuccess('Un professeur a ete ajouter');
        return $professor;
    }

    public function updated(string $key, $attributes, $factory): Model|Builder|null
    {
        $professor = $this->showProfessor(key: $key);
        $this->removePathOfImages(model: $professor);
        $professor->update([
            'username' => $attributes->input('name'),
            'firstname' => $attributes->input('firstName'),
            'lastname' => $attributes->input('lastName'),
            'personnelEmail' => $attributes->input('personnelEmail'),
            'phoneNumber' => $attributes->input('phone'),
            'nationality' => $attributes->input('nationality'),
            'images' => self::uploadFiles($attributes),
            'location' => $attributes->input('address'),
            'identityCard' => $attributes->input('identityCard'),
            'gender' => $attributes->input('birthdays'),
            'birthdays' => $attributes->input('birthdays'),
            'academic_year_id' => $attributes->input('academic'),
        ]);
        $factory->addSuccess('Une modification a ete effectuer');
        return $professor;
    }

    public function deleted(string $key, $factory): RedirectResponse
    {
        $professor = $this->showProfessor(key: $key);
        $this->removePathOfImages(model: $professor);
        $professor->delete();
        $factory->addSuccess('Un Professeur a ete supprimer');
        return back();
    }

    private function createProfessor($attributes, Model|Builder $user): Model|Builder
    {
        return Professor::query()
            ->create([
                'username' => $attributes->input('name'),
                'firstname' => $attributes->input('firstName'),
                'lastname' => $attributes->input('lastName'),
                'personnelEmail' => $attributes->input('personnelEmail'),
                'phoneNumber' => $attributes->input('phone'),
                'nationality' => $attributes->input('nationality'),
                'images' => self::uploadFiles($attributes),
                'location' => $attributes->input('address'),
                'identityCard' => $attributes->input('identityCard'),
                'gender' => $attributes->input('birthdays'),
                'birthdays' => $attributes->input('birthdays'),
                'academic_year_id' => $attributes->input('academic'),
                'user_id' => $user->id
            ]);
    }
}
