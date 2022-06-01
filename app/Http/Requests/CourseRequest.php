<?php

declare(strict_types=1);

namespace App\Http\Requests;

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
            'category' => ['required', Rule::exists('categories', 'id')],
            'professor' => ['nullable', Rule::exists('admin', 'id')],
            'name' => ['required', 'string', 'min:4'],
            'images' => ['required', 'image', 'mimes:jpg,png,svg,gif,jpeg'],
            'duration' => ['required', 'string', 'min:3'],
            'startDate' => ['required', 'date', 'date_format:Y-m-d', 'before:endDate'],
            'endDate' => ['required', 'date', 'date_format:Y-m-d', 'after:startDate'],
            'subDescription' => ['required', 'string', 'min:20'],
            'description' => ['nullable', 'string'],
        ];
    }
}
