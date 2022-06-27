<?php

declare(strict_types=1);

namespace App\Http\Requests;

use App\Models\Department;
use App\Models\Guardian;
use App\Models\Promotion;
use App\Models\Subsidiary;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Laravel\Sanctum\Guard;

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
            'name' => ['required', 'string'],
            'email' => ['required', 'email', 'regex:/(.+)@(.+)\.(.+)/i'],
            'password' => ['required', 'string', 'min:6'],
            'parent' => ['required', Rule::exists(Guardian::class, 'id')],
            'department' => ['required', Rule::exists(Department::class, 'id')],
            'filiaire' => ['required', Rule::exists(Subsidiary::class, 'id')],
            'class' => ['required', Rule::exists(Promotion::class, 'id')],
            'admission' => ['required', 'date'],
            'gender' => ['required', 'in:male,female'],
            'images' => ['required', 'image', 'mimes:jpg,png,gif,svg,jpeg'],
        ];
    }
}
