<?php

declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;
use Symfony\Component\HttpFoundation\Response;

class ProfessorUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        abort_if(Gate::denies('Personnel-create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

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
            'name' => ['required', 'string', 'min:4', 'max:255'],
            'firstName' => ['required', 'string', 'min:4', 'max:255'],
            'lastName' => ['required', 'string', 'min:4', 'max:255'],
            'email' => ['required', 'email', 'regex:/(.+)@(.+)\.(.+)/i'],
            'phones' => ['required', 'min:10', 'regex:/^([0-9\s\-\+\(\)]*)$/'],
            'nationality' => ['required', 'string', 'min:4', 'max:255'],
            'address' => ['required', 'string', 'min:7', 'max:255'],
            'identityCard' => ['required', 'string', 'min:10', 'max:255'],
            'birthdays' => ['required', 'date', 'date_format:Y-m-d'],
            'gender' => ['required'],
            'images' => ['required', 'image', 'mimes:jpg,png,svg,gif,jpeg'],
            'user' => ['required', Rule::exists('admin', 'id')],
        ];
    }
}
