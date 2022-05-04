<?php
declare(strict_types=1);

namespace App\View\Composers;

use App\Enums\RoleEnum;
use App\Models\AcademicYear;
use App\Models\Role;
use Illuminate\View\View;

class AcademicYearComposer
{
    public function compose(View $view): void
    {
        $view->with('academicYear', AcademicYear::query()
            ->get()
        );
    }
}
