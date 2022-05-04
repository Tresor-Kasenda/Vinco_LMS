<?php
declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

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
            "name" => ['required', 'string', 'min:4', 'max:255'],
            "firstName" => ['required', 'string', 'min:4', 'max:255'],
            "lastName" => ['required', 'string', 'min:4', 'max:255'],
            "email" => ['required', 'string', 'email', 'regex:/(.+)@(.+)\.(.+)/i'],
            "phones" => ['required', 'min:10', 'regex:/^([0-9\s\-\+\(\)]*)$/'],
            "nationality" => ['required', 'string', 'min:4', 'max:255'],
            "address" => ['required', 'string', 'min:7', 'max:255'],
            "identityCard" => ['required', 'string', 'min:10', 'max:255'],
            "role_id" => ['required', Rule::exists('roles', 'id')],
            "birthdays" => ['required', 'date', 'date_format:Y-m-d',],
            "gender" => ['required'],
            'academic' => ['required', Rule::exists('academic_years', 'id')]
        ];
    }
}
