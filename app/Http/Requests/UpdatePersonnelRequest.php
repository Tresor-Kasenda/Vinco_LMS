<?php

declare(strict_types=1);

namespace App\Http\Requests;

use App\Models\AcademicYear;
use App\Models\Institution;
use App\Models\Personnel;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;
use Symfony\Component\HttpFoundation\Response;

class UpdatePersonnelRequest extends FormRequest
{
    /**
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
            'name' => ['required', 'string', 'min:4', 'max:255'],
            'email' => ['required', 'string', 'email', 'regex:/(.+)@(.+)\.(.+)/i'],
            'phones' => ['required', 'min:10', 'regex:/^([0-9\s\-\+\(\)]*)$/'],
            'role' => ['required', Rule::exists('roles', 'id')],
            'academic' => ['required', Rule::exists('academic_years', 'id')],
            'gender' => ['required', 'in:male,female'],
            'institution' => ['required', Rule::exists(Institution::class, 'id')]
        ];
    }
}
