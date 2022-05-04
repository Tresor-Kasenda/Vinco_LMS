<?php
declare(strict_types=1);

namespace App\Http\Requests;

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
            'startDate' => ['required', 'date', 'date_format:m/d/Y', 'before:endDate'],
            'endDate' => ['required', 'date', 'date_format:m/d/Y', 'after:startDate']
        ];
    }
}
