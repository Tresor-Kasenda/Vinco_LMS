<?php

namespace App\View\Composers;

use App\Enums\StatusEnum;
use App\Models\AcademicYear;
use App\Models\Campus;
use Illuminate\View\View;

class CampusComposer
{
    public function compose(View $view): void
    {
        $view
            ->with(
                'campuses',
                Campus::query()
                ->when('status', fn ($builder) => $builder->where('status', StatusEnum::TRUE))
                ->get()
            );
    }
}
