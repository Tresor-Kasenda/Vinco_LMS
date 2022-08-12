<?php

namespace App\Http\Requests;

use App\Models\Department;
use App\Models\Guardian;
use App\Models\Promotion;
use App\Models\Subsidiary;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

final class UpdateStudentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
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
            'name' => ['required', 'string'],
            'email' => ['required', 'email', 'regex:/(.+)@(.+)\.(.+)/i'],
            'parent' => ['required', Rule::exists(Guardian::class, 'id')],
            'department' => ['required', Rule::exists(Department::class, 'id')],
            'filiaire' => ['required', Rule::exists(Subsidiary::class, 'id')],
            'class' => ['required', Rule::exists(Promotion::class, 'id')],
            'admission' => ['required', 'date'],
            'gender' => ['required', 'in:male,female'],
        ];
    }
}
