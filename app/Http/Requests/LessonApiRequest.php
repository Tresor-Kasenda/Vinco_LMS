<?php

declare(strict_types=1);

namespace App\Http\Requests;

use App\Models\Chapter;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

final class LessonApiRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules()
    {
        return [
            'chapter' => ['required', Rule::exists(Chapter::class, 'id')],
        ];
    }
}
