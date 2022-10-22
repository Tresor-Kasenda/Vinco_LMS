<?php

declare(strict_types=1);

namespace App\ViewModels\Backend\Permission;

use App\Http\Controllers\Backend\System\PermissionBackendController;
use Spatie\Permission\Models\Permission;
use Spatie\ViewModels\ViewModel;

class EditPermissionViewModel extends ViewModel
{
    public string $indexUrl;

    public function __construct(
        public Permission $permission
    ) {
        $this->indexUrl = action([PermissionBackendController::class, 'index']);
    }

    public function permission(): Permission
    {
        return $this->permission;
    }
}
