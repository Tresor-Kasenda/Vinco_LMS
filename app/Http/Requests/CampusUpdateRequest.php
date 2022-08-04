<?php

declare(strict_types=1);

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CampusUpdateRequest extends FormRequest
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
    public function rules()
    {
        return [
            'name' => ['required', 'string', 'min:4'],
            'images' => ['required', 'image', 'mimes:jpg,png,gif,svg,jpeg'],
            'description' => ['nullable'],
            'personnel' => ['required', Rule::exists('users', 'id')],
            'institution' => ['nullable', Rule::exists('institutions', 'id')],
        ];
    }
}
