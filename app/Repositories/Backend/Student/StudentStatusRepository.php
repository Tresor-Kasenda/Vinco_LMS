<?php

declare(strict_types=1);

namespace App\Repositories\Backend\Student;

use App\Http\Requests\Backend\Student\StudentStatusRequest;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use LaravelIdea\Helper\App\Models\_IH_User_QB;

class StudentStatusRepository
{
    public function handle(StudentStatusRequest $request): Model|_IH_User_QB|Builder|User|null
    {
        $admin = User::query()
            ->where('id', '=', $request->input('student'))
            ->first();
        $admin->update(['status' => $request->input('status')]);

        return $admin;
    }
}
