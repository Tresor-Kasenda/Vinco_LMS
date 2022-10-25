<?php

declare(strict_types=1);

namespace App\Repositories\Backend\Guardian;

use App\Http\Requests\Backend\Parent\ParentStatusRequest;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class ParentStatusRepository
{
    public function handle(ParentStatusRequest $request): Model|Builder|User|null
    {
        $admin = User::query()
            ->where('id', '=', $request->input('parent'))
            ->first();
        $admin->update(['status' => $request->input('status')]);

        return $admin;
    }
}
