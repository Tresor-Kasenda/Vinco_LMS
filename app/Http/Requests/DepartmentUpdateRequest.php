<?php

declare(strict_types=1);

namespace App\Http\Requests;

use App\Models\Campus;
use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use JetBrains\PhpStorm\ArrayShape;

class DepartmentUpdateRequest extends FormRequest
{
    #[ArrayShape(['name' => "string[]", 'user' => "array", 'campus' => "array", 'description' => "string[]"])]
    public function rules(): array
    {
        return [
            'name' => ['required', 'string'],
            'user' => ['required', Rule::exists(User::class, 'id')],
            'campus' => ['required', Rule::exists(Campus::class, 'id')],
            'description' => ['nullable'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
