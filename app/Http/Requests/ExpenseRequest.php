<?php

declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

final class ExpenseRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'expense' => ['required', Rule::exists('expense_types', 'id')],
            'institution' => ['required', Rule::exists('institutions', 'id')],
            'amount' => ['required', 'min:2'],
            'description' => ['nullable', 'string'],
        ];
    }
}
