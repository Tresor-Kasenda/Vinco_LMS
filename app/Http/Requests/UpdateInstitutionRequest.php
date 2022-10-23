<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

final class UpdateInstitutionRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'institution_name' => ['required', 'string', 'min:5'],
            'institution_country' => ['required', 'max:255', 'string', 'min:4'],
            'institution_town' => ['required', 'string'],
            'institution_email' => ['required', 'email', 'regex:/(.+)@(.+)\.(.+)/i'],
            'institution_phones' => ['required', 'max:255', 'regex:/^([0-9\s\-\+\(\)]*)$/'],
            'institution_website' => ['required', 'string', 'min:4'],
            'institution_address' => ['required', 'string', 'min:3'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
