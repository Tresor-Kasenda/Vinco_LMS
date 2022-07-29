<?php

declare(strict_types=1);

namespace App\Http\Requests;

use App\Models\AcademicYear;
use App\Models\Institution;
use App\Models\Personnel;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PersonnelRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'min:4', 'max:255'],
            'email' => [
                'required',
                'string',
                'email',
                'regex:/(.+)@(.+)\.(.+)/i',
                Rule::unique(Personnel::class, 'email'),
            ],
            'password' => ['required', 'string', 'min:6'],
            'phones' => [
                'required',
                'min:10',
                'regex:/^([0-9\s\-\+\(\)]*)$/',
                Rule::unique(Personnel::class, 'phones'),
            ],
            'gender' => ['required', 'in:male,female'],
            'images' => ['required', 'image', 'mimes:jpg,png,svg,gif,jpeg'],
            'academic' => ['required', Rule::exists(AcademicYear::class, 'id')],
            'institution' => ['required', Rule::exists(Institution::class, 'id')],
        ];
    }
}
