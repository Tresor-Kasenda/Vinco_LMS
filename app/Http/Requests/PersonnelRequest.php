<?php
declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PersonnelRequest extends FormRequest
{
    /**
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * @return array
     */
    public function rules()
    {
        return [
            "name" => ['required', 'string', 'min:4', 'max:255'],
            "firstName" => ['required', 'string', 'min:4', 'max:255'],
            "lastName" => ['required', 'string', 'min:4', 'max:255'],
            "email" => ['required', 'string', 'email'],
            "phone" => ['required', 'string', 'min:10'],
            "nationality" => ['required', 'string', 'min:4', 'max:255'],
            "address" => ['required', 'string', 'min:7', 'max:255'],
            "identityCard" => ['required', 'string', 'min:10', 'max:255'],
            "images" => ['required', 'image', 'mimes:jpeg,jpg,png'],
            "role_id" => ['required', Rule::exists('roles', 'id')],
            "birthdays" => ['required', 'date'],
            "gender" => ['required']
        ];
    }
}
