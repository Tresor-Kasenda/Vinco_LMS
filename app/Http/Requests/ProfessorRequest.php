<?php

declare(strict_types=1);

namespace App\Http\Requests;

use App\Models\Institution;
use App\Models\Professor;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;

final class ProfessorRequest extends FormRequest
{
    public function authorize(): bool
    {
        return Gate::allows('professor-create');
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'min:4', 'max:255'],
            'lastname' => ['required', 'string', 'min:4', 'max:255'],
            'email' => [
                'required',
                'string',
                'email',
                'regex:/(.+)@(.+)\.(.+)/i',
                Rule::unique(Professor::class, 'email'),
            ],
            'phones' => [
                'required',
                'min:10',
                'regex:/^([0-9\s\-\+\(\)]*)$/',
                Rule::unique(Professor::class, 'phones'),
            ],
            'images' => ['required', 'image', 'mimes:jpg,png,svg,gif,jpeg'],
            'password' => ['required', 'min:6'],
            'gender' => ['required', 'in:male,female'],
            'institution' => ['nullable', Rule::exists(Institution::class, 'id')],
        ];
    }
}
