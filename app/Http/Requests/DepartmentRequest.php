<?php

declare(strict_types=1);

namespace App\Http\Requests;

use App\Models\Campus;
use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class DepartmentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => ['required', 'string'],
            'images' => ['required', 'image', 'mimes:jpg,png,gif,svg,jpeg'],
            'user' => ['required', Rule::exists(User::class, 'id')],
            'campus' => ['required', Rule::exists(Campus::class, 'id')],
            'description' => ['nullable'],
        ];
    }
}
