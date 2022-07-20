<?php

declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class InstitutionRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'institution_name' => ['required', 'string', 'min:5', 'unique:institutions'],
            'institution_country' => ['required', 'max:255', 'string', 'min:4'],
            'institution_town' => ['required', 'string'],
            'manager' => [Rule::exists('users', 'id')],
            'institution_phones' => ['required', 'max:255', 'regex:/^([0-9\s\-\+\(\)]*)$/', 'unique:institutions'],
            'institution_website' => ['required', 'string', 'min:4'],
            'institution_email' => ['required', 'string', 'min:4'],
            'institution_address' => ['required', 'string', 'min:3'],
            'images' => ['required', 'image', 'mimes:jpg,png,gif,svg,jpeg'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
