<?php

declare(strict_types=1);

namespace App\Http\Requests;

use App\Models\Category;
use App\Models\Professor;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CourseRequest extends FormRequest
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
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'min:4', 'unique:courses'],
            'weighting' => ['required', 'integer'],
            'category' => ['required', Rule::exists(Category::class, 'id')],
            'professor' => ['nullable', Rule::exists(Professor::class, 'id')],
            'images' => ['required', 'image', 'mimes:jpg,png,svg,gif,jpeg'],
            'sub_description' => ['required', 'string', 'min:20'],
            'description' => ['nullable', 'string'],
        ];
    }
}
