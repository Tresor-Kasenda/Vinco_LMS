<?php

declare(strict_types=1);

namespace App\Http\Requests;

use App\Models\Exercice;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ExerciseRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'course' => ['nullable', Rule::exists('courses', 'id')],
            'chapter' => ['nullable', Rule::exists('chapters', 'id')],
            'lesson' => ['nullable', Rule::exists('lessons', 'id')],
            'name' => ['required', 'string', 'min:3', Rule::unique(Exercice::class, 'name')],
            'date' => ['required', 'date'],
            'rating' => ['required', 'string'],
        ];
    }
}
