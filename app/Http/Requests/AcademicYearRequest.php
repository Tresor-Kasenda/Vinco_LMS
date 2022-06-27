<?php

declare(strict_types=1);

namespace App\Http\Requests;

use App\Rules\RoutineTime;
use Illuminate\Foundation\Http\FormRequest;

class AcademicYearRequest extends FormRequest
{
    /**
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            'startDate' => [
                'required',
                'date',
                'date_format:Y-m-d',
                'before:endDate',
                new RoutineTime(),
            ],
            'endDate' => [
                'required',
                'date',
                'date_format:Y-m-d',
                'after:startDate',
                new RoutineTime(),
            ],
        ];
    }
}
