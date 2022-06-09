<?php

declare(strict_types=1);

namespace App\Http\Requests;

use App\Models\AcademicYear;
use App\Models\Campus;
use App\Models\Department;
use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class FiliaireRequest extends FormRequest
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
    public function rules()
    {
        return [
            'name' => ['required', 'string', 'min:3'],
            'images' => ['required', 'image', 'mimes:jpg,png,gif,svg,jpeg'],
            'user' => ['required', Rule::exists(User::class, 'id')],
            'department' => ['required', Rule::exists(Department::class, 'id')],
            'academic' => ['required', Rule::exists(AcademicYear::class, 'id')],
            'description' => ['nullable'],
        ];
    }
}
