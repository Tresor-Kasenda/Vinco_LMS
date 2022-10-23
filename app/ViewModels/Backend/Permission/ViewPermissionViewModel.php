<?php

declare(strict_types=1);

namespace App\ViewModels\Backend\Permission;

use App\Http\Controllers\Backend\System\PermissionBackendController;
use Illuminate\Database\Eloquent\Collection;
use Spatie\Permission\Models\Permission;
use Spatie\ViewModels\ViewModel;

class ViewPermissionViewModel extends ViewModel
{
    public string $createUrl;

    public function __construct()
    {
        $this->createUrl = action([PermissionBackendController::class, 'create']);
    }

    public function permissions(): Collection|array
    {
        return Permission::query()
            ->latest()
            ->get([
                'id',
                'name',
            ]);
    }
}
