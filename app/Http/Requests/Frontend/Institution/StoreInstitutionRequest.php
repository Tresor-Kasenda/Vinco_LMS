<?php

declare(strict_types=1);

namespace App\Http\Requests\Frontend\Institution;

use App\Models\Institution;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreInstitutionRequest extends FormRequest
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
            'institution_name' => [
                'required',
                'string',
                'min:5',
                Rule::unique(Institution::class, 'institution_name'),
            ],
            'institution_country' => ['required', 'max:255', 'string', 'min:4'],
            'institution_town' => ['required', 'string'],
            'institution_email' => [
                'required',
                'email',
                'regex:/(.+)@(.+)\.(.+)/i',
                Rule::unique(Institution::class, 'institution_email'),
            ],
            'institution_phones' => [
                'required',
                'max:255',
                'regex:/^([0-9\s\-\+\(\)]*)$/',
                Rule::unique(Institution::class, 'institution_phones'),
            ],
            'institution_website' => ['required', 'string', 'min:4'],
            'institution_address' => ['required', 'string', 'min:3'],
            'images' => ['required', 'image', 'mimes:jpg,png,gif,svg,jpeg'],
        ];
    }
}
