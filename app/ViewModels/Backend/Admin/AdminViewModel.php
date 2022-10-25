<?php

declare(strict_types=1);

namespace App\ViewModels\Backend\Admin;

use App\Http\Controllers\Backend\Admin\UsersBackendController;
use App\Models\Institution;
use Illuminate\Database\Eloquent\Collection;
use Spatie\Permission\Models\Role;
use Spatie\ViewModels\ViewModel;

class AdminViewModel extends ViewModel
{
    public string $indexUrl;

    public function __construct()
    {
        $this->indexUrl = action([UsersBackendController::class, 'index']);
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
