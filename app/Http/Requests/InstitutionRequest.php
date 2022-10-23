<?php

declare(strict_types=1);

namespace App\Http\Requests;

use App\Models\Institution;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

final class InstitutionRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'institution_name' => [
                'required',
                'string',
                'min:5',
                Rule::unique(Institution::class, 'institution_name'),
            ],
            'institution_country' => ['required', 'max:255', 'string', 'min:4'],
            'institution_town' => ['required', 'string'],
            'institution_phones' => [
                'required',
                'max:255',
                'regex:/^([0-9\s\-\+\(\)]*)$/',
                Rule::unique(Institution::class, 'institution_phones'),
            ],
            'institution_website' => ['required', 'string', 'min:4'],
            'institution_email' => [
                'required',
                'email',
                'regex:/(.+)@(.+)\.(.+)/i',
                Rule::unique(Institution::class, 'institution_email'),
            ],
            'institution_address' => ['required', 'string', 'min:3'],
            'images' => ['required', 'image', 'mimes:jpg,png,gif,svg,jpeg'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
