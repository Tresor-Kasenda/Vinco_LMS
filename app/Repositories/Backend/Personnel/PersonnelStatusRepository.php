<?php

declare(strict_types=1);

namespace App\Repositories\Backend\Personnel;

use App\Http\Requests\Backend\Personnel\PersonnelStatusRequest;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class PersonnelStatusRepository
{
    public function handle(PersonnelStatusRequest $request): Model|Builder|User|null
    {
        $admin = User::query()
            ->where('id', '=', $request->input('personnel'))
            ->first();
        $admin->update(['status' => $request->input('status')]);

        return $admin;
    }
}
