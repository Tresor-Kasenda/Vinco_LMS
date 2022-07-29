<?php

namespace App\Http\Requests;

use App\Models\Department;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class FiliaireApiRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'department' => ['required', Rule::exists(Department::class, 'id')]
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
