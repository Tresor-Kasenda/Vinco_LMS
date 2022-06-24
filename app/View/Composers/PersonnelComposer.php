<?php

declare(strict_types=1);

namespace App\View\Composers;

use App\Enums\RoleEnum;
use App\Models\Role;
use App\Models\User;
use Illuminate\View\View;

class PersonnelComposer
{
    public function compose(View $view): void
    {
        $view->with(
            'admin',
            User::query()
            ->when('deleted_at', fn ($query) => $query->where('deleted_at', null))
            ->get()
        );
    }
}
