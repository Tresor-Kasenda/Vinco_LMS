<?php

declare(strict_types=1);

namespace App\Http\Requests;

use App\Models\Department;
use App\Models\Guardian;
use App\Models\Promotion;
use App\Models\Student;
use App\Models\Subsidiary;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StudentRequest extends FormRequest
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
            'department' => [Rule::exists(Department::class, 'id')],
            'promotion' => [Rule::exists(Promotion::class, 'id')],
            'filiaire' => [Rule::exists(Subsidiary::class, 'id')],
            'name' => ['required', 'string'],
            'firstname' => ['required', 'string'],
            'lastname' => ['required', 'string'],
            'email' => ['required', 'email', 'regex:/(.+)@(.+)\.(.+)/i', Rule::unique(Student::class, 'email')],
            'images' => ['image', 'mimes:jpg,png,gif,svg,jpeg'],
            'gender' => ['required', 'in:male,female'],
            'parent' => [Rule::exists(Guardian::class, 'id')],
            'admission' => ['date'],
            'password' => ['required', 'string', 'min:6'],

        ];
    }
}
