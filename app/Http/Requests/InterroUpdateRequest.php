<?php

declare(strict_types=1);

namespace App\Http\Requests;

use App\Models\Chapter;
use App\Models\Course;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class InterroUpdateRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'rating' => ['required', 'integer'],
            'duration' => ['required'],
            'date' => ['required', 'date'],
            'course' => ['required', Rule::exists(Course::class, 'id')],
            'chapter' => ['required', Rule::exists(Chapter::class, 'id')]
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
