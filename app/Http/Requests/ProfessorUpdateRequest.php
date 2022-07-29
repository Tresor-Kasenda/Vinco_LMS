<?php

declare(strict_types=1);

namespace App\Http\Requests;

use App\Models\Institution;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProfessorUpdateRequest extends FormRequest
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
            'email' => ['required', 'email', 'regex:/(.+)@(.+)\.(.+)/i'],
            'phones' => ['required', 'min:10', 'regex:/^([0-9\s\-\+\(\)]*)$/'],
            'gender' => ['required', 'in:male,female'],
            'institution' => ['nullable', Rule::exists(Institution::class, 'id')],
        ];
    }
}
