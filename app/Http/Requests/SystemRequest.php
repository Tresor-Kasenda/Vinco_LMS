<?php

declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

final class SystemRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
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
            'timezone' => ['required', 'string', 'timezone'],
            'routine_time_difference' => ['required', Rule::in([
                '10',
                '20',
                '25',
                '30',
                '35',
                '40',
                '45',
                '50',
                '55',
                '90',
            ])],
            'class_start' => ['required'],
            'end_start' => ['required'],
        ];
    }
}
