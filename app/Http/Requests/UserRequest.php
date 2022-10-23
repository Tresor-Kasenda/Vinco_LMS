<?php

declare(strict_types=1);

namespace App\Http\Requests;

use App\Models\Institution;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Spatie\Permission\Models\Role;

final class UserRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'min:4'],
            'email' => [
                'required',
                'string',
                'email',
                'regex:/(.+)@(.+)\.(.+)/i',
            ],
            'role_id' => [
                'required',
                Rule::exists(Role::class, 'id'),
            ],
            'institution' => [
                'required',
                Rule::exists(Institution::class, 'id'),
            ],
            'password' => ['required', 'string', 'min:8'],
        ];
    }
}
