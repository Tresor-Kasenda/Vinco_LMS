<?php

declare(strict_types=1);

namespace App\Http\Requests;

use App\Models\Institution;
use App\Models\Role;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserRequest extends FormRequest
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
            'name' => ['required', 'string', 'min:4'],
            'email' => ['required', 'string', 'email', 'regex:/(.+)@(.+)\.(.+)/i'],
            'role_id' => ['required', Rule::exists(Role::class, 'id')],
            'institution' => ['required', Rule::exists(Institution::class, 'id')],
            'password' => ['required', 'string', 'min:8'],
        ];
    }
}
