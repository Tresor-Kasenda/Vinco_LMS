<?php

declare(strict_types=1);

namespace App\Repositories\Backend;

use App\Contracts\StudentRepositoryInterface;
use App\Enums\StatusEnum;
use App\Models\Student;
use App\Models\User;
use App\Traits\ImageUploader;
use App\Traits\RandomValues;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\RedirectResponse;
use Spatie\Permission\Models\Role;

class StudentRepository implements StudentRepositoryInterface
{
    use ImageUploader, RandomValues;

    /**
     * @return array|Collection
     */
    public function students(): array|Collection
    {
        return Student::query()
            ->orderByDesc('created_at')
            ->get();
    }

    /**
     * @param string $key
     * @return Model|Student|Builder
     */
    public function showStudent(string $key): Model|Student|Builder
    {
        return Student::query()
            ->where('id', '=', $key)
            ->firstOrFail();
    }

    /**
     * @param $attributes
     * @param $factory
     * @return Student|Model|Builder
     */
    public function stored($attributes, $factory): Student|Model|Builder
    {
        $user = User::query()
            ->create([
                'name' => $attributes->input('name'),
                'email' => $attributes->input('email'),
                'password' => \Hash::make($attributes->input('password')),
            ]);

        $role = Role::query()
            ->where('name', '=', 'Student')
            ->firstOrFail();
        $user->assignRole($role->id);

        $student = Student::query()
            ->create([
                'user_id' => $user->id,
                'department_id' => $attributes->input('department'),
                'promotion_id' => $attributes->input('class'),
                'subsidiary_id' => $attributes->input('filiaire'),
                'firstname' => $attributes->input('name'),
                'email' => $attributes->input('email'),
                'middlename' =>$attributes->input('name'),
                'images' => self::uploadFiles($attributes),
                'status' => StatusEnum::TRUE,
                'gender' => $attributes->input('gender'),
                'guardian_id' => $attributes->input('parent'),
                'admission' => $attributes->input('admission'),
                'matriculate' => $this->generateRandomTransaction(8),
            ]);
        $factory->addSuccess('Un Etudiant a ete ajouter');

        return $student;
    }

    /**
     * @param string $key
     * @param $attributes
     * @param $factory
     * @return Model|Student|Builder
     */
    public function updated(string $key, $attributes, $factory): Model|Student|Builder
    {
        $student = $this->showStudent($key);
        $this->removePathOfImages($student);
        $student->update([
            'department_id' => $attributes->input('department'),
            'promotion_id' => $attributes->input('class'),
            'subsidiary_id' => $attributes->input('filiaire'),
            'firstname' => $attributes->input('name'),
            'email' => $attributes->input('email'),
            'gender' => $attributes->input('gender'),
            'guardian_id' => $attributes->input('parent'),
            'admission' => $attributes->input('admission'),
        ]);
        $factory->addSuccess('Un Etudiant a ete modifier');

        return $student;
    }

    public function deleted(string $key, $factory): Model|Student|Builder|RedirectResponse
    {
        $student = $this->showStudent($key);
        if ($student->status !== StatusEnum::FALSE) {
            $factory->addError('Veillez desactiver avant de le mettre dans la corbeille');

            return back();
        }
        $student->delete();
        $factory->addSuccess('Un Etudiant a ete modifier');

        return $student;
    }

    public function changeStatus($attributes): bool|int
    {
        $student = $this->showStudent(key: $attributes->input('key'));
        if ($student != null) {
            return $student->update([
                'status' => $attributes->input('status'),
            ]);
        }

        return false;
    }
}
