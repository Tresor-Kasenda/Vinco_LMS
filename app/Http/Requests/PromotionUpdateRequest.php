<?php

namespace App\Http\Requests;

use App\Models\AcademicYear;
use App\Models\Subsidiary;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

final class PromotionUpdateRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => ['required', 'string'],
            'filiaire' => ['required', Rule::exists(Subsidiary::class, 'id')],
            'academic' => ['required', Rule::exists(AcademicYear::class, 'id')],
            'description' => ['nullable'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
