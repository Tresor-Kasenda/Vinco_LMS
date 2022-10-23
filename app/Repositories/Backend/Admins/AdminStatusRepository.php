<?php

declare(strict_types=1);

namespace App\Repositories\Backend\Admins;

use App\Http\Requests\Backend\Admins\AdminStatusRequest;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class AdminStatusRepository
{
    public function handle(AdminStatusRequest $request): Model|Builder|User|null
    {
        $admin = User::query()
            ->where('id', '=', $request->input('admin'))
            ->first();
        $admin->update(['status' => $request->input('status')]);
        return $admin;
    }
}
