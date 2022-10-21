<?php

declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;

final class ParentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return Gate::allows('parent-create');
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'min:3'],
            'email' => ['required', 'email', 'regex:/(.+)@(.+)\.(.+)/i', Rule::unique('guardians', 'email_guardian')],
            'password' => ['required', 'string', 'min:6'],
            'phones' => ['required', 'min:10', 'regex:/^([0-9\s\-\+\(\)]*)$/', Rule::unique('guardians', 'phones')],
            'gender' => ['required', 'in:male,female'],
            'images' => ['required', 'image', 'mimes:jpg,png,svg,gif,jpeg'],
        ];
    }
}
