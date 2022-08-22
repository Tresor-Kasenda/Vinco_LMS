<?php

declare(strict_types=1);

namespace App\Rules;

use App\Models\AcademicYear;
use Illuminate\Contracts\Validation\Rule;

final class RoutineTime implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     */
    public function passes($attribute, $value): bool
    {
        return AcademicYear::query()
            ->where('start_date', '<=', $value)
            ->where('end_date', '>=', $value)
            ->count() == 0;
    }

    /**
     * Get the validation error message.
     */
    public function message(): string
    {
        return 'Cette annee existe deja.';
    }
}
