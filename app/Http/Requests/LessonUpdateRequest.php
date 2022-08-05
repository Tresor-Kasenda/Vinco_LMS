<?php

namespace App\Http\Requests;

use App\Models\Chapter;
use App\Models\LessonType;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

final class LessonUpdateRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'min:3'],
            'type' => ['required', Rule::exists(LessonType::class, 'id')],
            'chapter' => ['required', Rule::exists(Chapter::class, 'id')],
            'content' => ['nullable', 'string'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
