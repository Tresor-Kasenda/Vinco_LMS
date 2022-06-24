<?php

declare(strict_types=1);

namespace App\View\Composers;

use App\Enums\RoleEnum;
use App\Models\Role;
use App\Models\User;
use Illuminate\View\View;

class DepartmentComposer
{
    public function compose(View $view): void
    {
        $view->with(
            'departmentHead',
            User::query()
            ->when('deleted_at', function ($query) {
                $query->where('deleted_at', null);
            })
            ->get()
        );
    }
}
