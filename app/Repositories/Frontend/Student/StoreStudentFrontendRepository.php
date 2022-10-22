<?php

declare(strict_types=1);

namespace App\Repositories\Frontend\Student;

use App\Contracts\Student\StoreStudentFrontendRepositoryInterface;
use App\Enums\StatusEnum;
use App\Events\Frontend\Student\StoreStudentEvent;
use App\Http\Requests\Frontend\Student\StoreStudentRequest;
use App\Models\Student;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;

class StoreStudentFrontendRepository implements StoreStudentFrontendRepositoryInterface
{
    /**
     * @param StoreStudentRequest $request
     * @return Model|Student|Builder
     */
    public function store(StoreStudentRequest $request): Model|Student|Builder
    {
        $user = $this->storeUser($request);
        StoreStudentEvent::dispatch($user);
        return $this->storeStudent($user, $request);
    }

    /**
     * @param StoreStudentRequest $request
     * @return Model|Builder|User
     */
    private function storeUser(StoreStudentRequest $request):Model|Builder|User
    {
        return User::query()
            ->create([
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'institution_id' => $request->input('institution'),
                'password' => Hash::make($request->input('name')),
                'status' => StatusEnum::FALSE
            ]);
    }

    /**
     * @param User $user
     * @param StoreStudentRequest $request
     * @return Model|Student|Builder
     */
    private function storeStudent(User $user, StoreStudentRequest $request): Model|Student|Builder
    {
        return Student::query()
            ->create([
                'user_id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'phone_number' => $request->input('phone_number'),
                'lastname' => $request->input('lastname'),
                'firstname' => $request->input('firstname'),
                'birthdays' => $request->input('birthdays'),
                'nationality' => $request->input('country'),
                'born_town' => $request->input('town'),
                'gender' => $request->input('gender')
            ]);
    }
}
