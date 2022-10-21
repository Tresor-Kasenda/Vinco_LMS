<?php

declare(strict_types=1);

namespace App\Rules;

use App\Models\AcademicYear;
use Illuminate\Contracts\Validation\Rule;

final class RoutineTime implements Rule
{
    public function __construct()
    {
        //
    }

    public function passes($attribute, $value): bool
    {
        return AcademicYear::query()
            ->where('start_date', '<=', $value)
            ->where('end_date', '>=', $value)
            ->count() == 0;
    }
    
    public function message(): string
    {
        return 'Cette annee existe deja.';
    }
}
