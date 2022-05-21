<?php
declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProfessorRequest extends FormRequest
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
            "name" => ['required', 'string', 'min:4', 'max:255'],
            "firstName" => ['required', 'string', 'min:4', 'max:255'],
            "lastName" => ['required', 'string', 'min:4', 'max:255'],
            "email" => ['required', 'string', 'email', 'regex:/(.+)@(.+)\.(.+)/i', 'unique:professors'],
            "phones" => ['required', 'min:10', 'regex:/^([0-9\s\-\+\(\)]*)$/'],
            "nationality" => ['required', 'string', 'min:4', 'max:255'],
            "address" => ['required', 'string', 'min:7', 'max:255'],
            "identityCard" => ['required', 'string', 'min:10', 'max:255', 'unique:professors'],
            "birthdays" => ['required', 'date', 'date_format:Y-m-d'],
            "gender" => ['required'],
            "images" => ['required', 'image', 'mimes:jpg,png,svg,gif,jpeg'],
            "user" => ['required', Rule::exists('users', 'id')],
        ];
    }
}
