<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ExerciceUpdateRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'course' => ['nullable', Rule::exists('courses', 'id')],
            'chapter' => ['nullable', Rule::exists('chapters', 'id')],
            'lesson' => ['nullable', Rule::exists('lessons', 'id')],
            'name' => ['required', 'string', 'min:3'],
            'date' => ['required', 'date'],
            'rating' => ['required', 'string'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
