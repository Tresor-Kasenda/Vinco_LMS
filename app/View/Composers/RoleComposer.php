<?php
declare(strict_types=1);

namespace App\View\Composers;

use App\Enums\RoleEnum;
use App\Models\Role;
use Illuminate\View\View;

class RoleComposer
{
    public function compose(View $view): void
    {
        $view->with('roles', Role::query()
            ->where('id', '!=', RoleEnum::ADMIN)
            ->where('id', '!=', RoleEnum::STUDENT)
            ->get()
        );
    }
}
