<?php

declare(strict_types=1);

namespace App\Http\Requests\Frontend\Student;

use App\Models\Institution;
use App\Models\Student;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreStudentRequest extends FormRequest
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
            'institution' => [
                'required',
                'integer',
                Rule::exists(Institution::class, 'id'),
            ],
            'firstname' => [
                'required',
                'string',
            ],
            'name' => [
                'required',
                'string',
            ],
            'lastname' => [
                'required',
                'string',
            ],
            'birthdays' => [
                'required',
                'date',
            ],
            'email' => [
                'required',
                'email',
                'regex:/(.+)@(.+)\.(.+)/i',
                Rule::unique(Student::class, 'email'),
            ],
            'country' => [
                'required',
                'max:255',
                'string',
            ],
            'town' => [
                'required',
                'string',
            ],
            'phone_number' => [
                'required',
                'max:255',
                'regex:/^([0-9\s\-\+\(\)]*)$/',
                Rule::unique(Student::class, 'phone_number'),
            ],
            'gender' => [
                'required',
                'in:male,female',
            ],
        ];
    }
}
