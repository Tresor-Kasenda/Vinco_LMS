<?php

declare(strict_types=1);

namespace App\Http\Requests;

use App\Models\Chapter;
use App\Models\Course;
use App\Models\Lesson;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

final class ExerciseRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'course' => ['nullable', Rule::exists(Course::class, 'id')],
            'chapter' => ['nullable', Rule::exists(Chapter::class, 'id')],
            'lesson' => ['nullable', Rule::exists(Lesson::class, 'id')],
            'name' => ['required', 'string', 'min:3'],
            'date' => ['required', 'date'],
            'rating' => ['required', 'string'],
        ];
    }
}
