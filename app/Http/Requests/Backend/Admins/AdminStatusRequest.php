<?php

declare(strict_types=1);

namespace App\Http\Requests\Backend\Admins;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class AdminStatusRequest extends FormRequest
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
            'admin' => [
                'required',
                Rule::exists(User::class, 'id'),
            ],
            'status' => [
                'required',
                'boolean',
            ],
        ];
    }
}
