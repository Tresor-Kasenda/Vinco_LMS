<?php

declare(strict_types=1);

namespace App\Http\Requests;

use App\Models\Category;
use App\Models\Institution;
use App\Models\Professor;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateCourseRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'min:4'],
            'weighting' => ['required', 'integer'],
            'institution' => ['nullable', Rule::exists(Institution::class, 'id')],
            'category' => ['required', Rule::exists(Category::class, 'id')],
            'professor' => ['nullable', Rule::exists(Professor::class, 'id')],
            'images' => ['required', 'image', 'mimes:jpg,png,svg,gif,jpeg'],
            'description' => ['nullable', 'string'],
        ];
    }
}
