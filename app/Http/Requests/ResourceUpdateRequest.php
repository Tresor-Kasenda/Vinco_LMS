<?php

namespace App\Http\Requests;

use App\Models\Chapter;
use App\Models\Lesson;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

final class ResourceUpdateRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'min:3'],
            'chapter' => ['required', Rule::exists(Chapter::class, 'id')],
            'lesson' => ['required', Rule::exists(Lesson::class, 'id')],
            'files' => ['required', 'mimes:png,jpg,jpeg,csv,txt,xlx,xls,pdf,sgv'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
