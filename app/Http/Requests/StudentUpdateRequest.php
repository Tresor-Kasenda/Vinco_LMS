<?php

namespace App\Http\Requests;

use App\Models\Department;
use App\Models\Guardian;
use App\Models\Promotion;
use App\Models\Subsidiary;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

final class StudentUpdateRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'department' => ['required', Rule::exists(Department::class, 'id')],
            'promotion' => ['required', Rule::exists(Promotion::class, 'id')],
            'filiaire' => ['required', Rule::exists(Subsidiary::class, 'id')],
            'name' => ['required', 'string', 'min:3'],
            'firstname' => ['required', 'string', 'min:3'],
            'email' => ['required', 'email', 'regex:/(.+)@(.+)\.(.+)/i'],
            'gender' => ['required', 'in:male,female'],
            'parent' => ['nullable', Rule::exists(Guardian::class, 'id')],
            'admission' => ['required', 'date'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
