<?php

declare(strict_types=1);

namespace App\ViewModels\Backend\Admin;

use App\Http\Controllers\Backend\Admin\UsersBackendController;
use App\Models\Institution;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use LaravelIdea\Helper\App\Models\_IH_User_QB;
use Spatie\Permission\Models\Role;
use Spatie\ViewModels\ViewModel;

class EditAdminViewModel extends ViewModel
{
    public string $indexUrl;

    public string $updateUrl;

    public function __construct(
        public string|int $id
    ) {
        $this->indexUrl = action([UsersBackendController::class, 'index']);
        $this->updateUrl = action([UsersBackendController::class, 'update'], $this->id);
    }

    public function admin(): Model|_IH_User_QB|Builder|User|null
    {
        return User::query()
            ->where('id', '=', $this->id)
            ->first();
    }

    public function roles(): Collection|array
    {
        return Role::query()
            ->select(['id', 'name'])
            ->whereIn('name', ['Admin', 'Super Admin'])
            ->get();
    }

    public function institutions(): array|Collection|\Illuminate\Support\Collection
    {
        return Institution::select(['id', 'institution_name'])->get();
    }
}
