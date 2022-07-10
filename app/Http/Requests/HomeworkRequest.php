<?php

declare(strict_types=1);

namespace App\Http\Requests;

use App\Models\Chapter;
use App\Models\Course;
use App\Models\Homework;
use App\Models\Lesson;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class HomeworkRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', Rule::unique(Homework::class, 'name')],
            'course' => ['nullable', Rule::exists(Course::class, 'id')],
            'chapter' => ['required', Rule::exists(Chapter::class, 'id')],
            'lesson' => ['required', Rule::exists(Lesson::class, 'id')],
            'rating' => ['required', 'integer'],
            'date' => ['required'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
