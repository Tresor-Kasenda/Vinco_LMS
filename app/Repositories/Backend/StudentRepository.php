<?php

declare(strict_types=1);

namespace App\Repositories\Backend;

use App\Contracts\StudentRepositoryInterface;
use App\Enums\StatusEnum;
use App\Models\Role;
use App\Models\Student;
use App\Models\User;
use App\Services\SendEmailConfirmation;
use App\Services\ToastMessageService;
use App\Traits\ImageUploader;
use App\Traits\RandomValues;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\RedirectResponse;
use Laratrust\Models\LaratrustRole;
use LaravelIdea\Helper\App\Models\_IH_Role_QB;
use LaravelIdea\Helper\App\Models\_IH_Student_QB;
use LaravelIdea\Helper\App\Models\_IH_User_QB;

class StudentRepository implements StudentRepositoryInterface
{
    use ImageUploader, RandomValues;

    public function __construct(protected ToastMessageService $service, protected SendEmailConfirmation $confirmation)
    {
    }

    public function students(): array|Collection
    {
        if (auth()->user()->hasRole('Super Admin')) {
            return Student::query()
                ->select([
                    'id',
                    'name',
                    'firstname',
                    'lastname',
                    'matriculate',
                    'department_id',
                    'subsidiary_id',
                    'email',
                    'images',
                ])
                ->with('subsidiary:id,name')
                ->whereHas('department', function ($builder) {
                    $builder->with([
                        'campus:id,name,institution_id' => [
                            'institution:id,institution_name',
                        ],
                    ]);
                })
                ->orderByDesc('created_at')
                ->get();
        }

        return Student::query()
            ->select([
                'id',
                'name',
                'firstname',
                'lastname',
                'matriculate',
                'department_id',
                'subsidiary_id',
                'email',
                'images',
            ])
            ->with('subsidiary:id,name')
            ->whereHas('department', function ($builder) {
                $builder->whereHas('campus', function ($builder) {
                    $builder->where('institution_id', auth()->user()->institution->id);
                });
            })
            ->orderByDesc('created_at')
            ->get();
    }

    public function showStudent(string $key): Model|Student|Builder
    {
        $student = Student::query()
            ->select([
                'id',
                'name',
                'firstname',
                'lastname',
                'matriculate',
                'department_id',
                'subsidiary_id',
                'email',
                'phone_number',
                'images',
                'nationality',
                'location',
                'promotion_id',
                'identity_card',
                'birthdays',
                'born_city',
                'born_town',
                'parent_name',
                'parent_phone',
                'born_town',
                'gender',
                'guardian_id',
                'admission_date',
                'user_id',
            ])
            ->where('id', '=', $key)
            ->firstOrFail();

        return $student->load([
            'parent:id,name_guardian,email_guardian,phones',
            'department:id,name',
            'subsidiary:id,name',
            'user:id',
            'user.roles:id,name',
            'parent:id,name_guardian',
        ]);
    }

    public function stored($attributes): Student|Model|Builder|RedirectResponse
    {
        $user = $this->verifyIfUserEmailExist($attributes);
        if (! $user) {

            $user = $this->createStudentBelongToUser($attributes);
            $role = $this->getStudentRole();
            $user->attachRole($role->id);
            $student = $this->storeStudent($user, $attributes);
            $result = $student ? $this->confirmation->send($student) : '';
            $this->service->success('Un Etudiant a ete ajouter avec succes');
            return $student;
        }
        $this->service->warning('Cette email a ete deja utiliser sur un autre compte');

        return back();
    }

    public function updated(string $key, $attributes): Model|Student|Builder
    {
        $student = $this->showStudent($key);
        $student->update([
            'department_id' => $attributes->input('department'),
            'promotion_id' => $attributes->input('promotion'),
            'subsidiary_id' => $attributes->input('filiaire'),
            'name' => $attributes->input('name'),
            'firstname' => $attributes->input('firstname'),
            'lastname' => $attributes->input('lastname'),
            'email' => $attributes->input('email'),
            'gender' => $attributes->input('gender'),
            'guardian_id' => $attributes->input('parent'),
            'admission_date' => $attributes->input('admission'),
        ]);
        $this->service->success('Un Etudiant a ete modifier');

        return $student;
    }

    public function deleted(string $key): Model|Student|Builder|RedirectResponse
    {
        $student = $this->showStudent($key);
        if ($student->status !== StatusEnum::FALSE) {
            $this->service->warning('Veillez desactiver avant de le mettre dans la corbeille');

            return back();
        }
        $student->delete();
        $this->service->success('Un Etudiant a ete supprimer');

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

    private function verifyIfUserEmailExist($attributes): null|User|Builder|Model|_IH_User_QB
    {
        return User::query()
            ->where('email', '=', $attributes->input('email'))
            ->first();
    }

    private function createStudentBelongToUser($attributes): User|Builder|Model|_IH_User_QB
    {
        return User::query()
            ->create([
                'name' => $attributes->input('name'),
                'email' => $attributes->input('email'),
                'institution_id' => $attributes->input('institution'),
                'avatar' => self::uploadFiles($attributes),
                'password' => \Hash::make($attributes->input('password')),
            ]);
    }

    private function getStudentRole(): _IH_Role_QB|Role|LaratrustRole|null|Builder|Model
    {
        return Role::query()
            ->where('name', '=', 'Etudiant')
            ->first();
    }

    private function storeStudent($user, $attributes): _IH_Student_QB|Builder|Model|Student
    {
        return Student::query()
            ->create([
                'user_id' => $user->id,
                'department_id' => $attributes->input('department'),
                'promotion_id' => $attributes->input('promotion'),
                'subsidiary_id' => $attributes->input('filiaire'),
                'name' => $attributes->input('name'),
                'firstname' => $attributes->input('firstname'),
                'lastname' => $attributes->input('lastname'),
                'nationality' => $attributes->input('nationality'),
                'location' => $attributes->input('location'),
                'email' => $attributes->input('email'),
                'images' => self::uploadFiles($attributes),
                'status' => StatusEnum::TRUE,
                'gender' => $attributes->input('gender'),
                'guardian_id' => $attributes->input('parent'),
                'admission_date' => $attributes->input('admission'),
                'matriculate' => $this->generateRandomTransaction(8, $attributes->input('name')),
            ]);
    }
}
