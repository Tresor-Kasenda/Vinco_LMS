<?php

declare(strict_types=1);

namespace App\ViewModels\Backend\Role;

use App\Http\Controllers\Backend\System\RoleBackendController;
use Illuminate\Database\Eloquent\Collection;
use Spatie\Permission\Models\Role;
use Spatie\ViewModels\ViewModel;

class RoleViewModel extends ViewModel
{
    public string $createUrl;
    
    public function __construct()
    {
        $this->createUrl = action([RoleBackendController::class, 'create']);
    }

    public function roles(): Collection|array
    {
        return Role::query()
            ->with('permissions')
            ->orderByDesc('created_at')
            ->get([
                'id',
                'name'
            ]);
    }
}
