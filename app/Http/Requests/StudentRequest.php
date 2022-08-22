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

final class StudentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

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
            'parent' => ['nullable', Rule::exists(Guardian::class, 'id')],
            'admission' => ['date'],
            'password' => ['required', 'string', 'min:6'],

        ];
    }
}
