<?php

declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;
use Symfony\Component\HttpFoundation\Response;

class ProfessorRequest extends FormRequest
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
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'min:4', 'max:255'],
            'lastname' => ['required', 'string', 'min:4', 'max:255'],
            'email' => ['required', 'string', 'email', 'regex:/(.+)@(.+)\.(.+)/i', Rule::unique('professors', 'email')],
            'phones' => ['required', 'min:10', 'regex:/^([0-9\s\-\+\(\)]*)$/'],
            'images' => ['required', 'image', 'mimes:jpg,png,svg,gif,jpeg'],
            'password' => ['required', 'min:6'],
            'gender' => ['required', 'in:male,female'],
        ];
    }
}
