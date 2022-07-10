<?php

declare(strict_types=1);

namespace App\Http\Requests;

use App\Models\Chapter;
use App\Models\LessonType;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class LessonRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'min:3', 'unique:lessons'],
            'type' => ['required', Rule::exists(LessonType::class, 'id')],
            'chapter' => ['required', Rule::exists(Chapter::class, 'id')],
            'content' => ['nullable', 'string'],
        ];
    }
}
