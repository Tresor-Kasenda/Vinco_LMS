<?php

declare(strict_types=1);

namespace App\Repositories\Backend\Professor;

use App\Http\Requests\Backend\Professor\ProfessorStatusRequest;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use LaravelIdea\Helper\App\Models\_IH_User_QB;

class ProfessorStatusRepository
{
    public function handle(ProfessorStatusRequest $request): Model|_IH_User_QB|Builder|User|null
    {
        $admin = User::query()
            ->where('id', '=', $request->input('professor'))
            ->first();
        $admin->update(['status' => $request->input('status')]);

        return $admin;
    }
}
