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
            'name' => ['required', 'string', 'min:4', 'max:255'],
            'firstName' => ['required', 'string', 'min:4', 'max:255'],
            'lastName' => ['required', 'string', 'min:4', 'max:255'],
            'email' => ['required', 'string', 'email', 'regex:/(.+)@(.+)\.(.+)/i', 'unique:personnels'],
            'phones' => ['required', 'min:10', 'regex:/^([0-9\s\-\+\(\)]*)$/'],
            'nationality' => ['required', 'string', 'min:4', 'max:255'],
            'address' => ['required', 'string', 'min:7', 'max:255'],
            'identityCard' => ['required', 'string', 'min:10', 'max:255', 'unique:personnels'],
            'user' => ['required', Rule::exists('admin', 'id')],
            'birthdays' => ['required', 'date', 'date_format:Y-m-d'],
            'gender' => ['required'],
            'academic' => ['required', Rule::exists('academic_years', 'id')],
            'images' => ['required', 'image', 'mimes:jpg,png,svg,gif,jpeg'],
        ];
    }
}
