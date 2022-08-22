<?php

declare(strict_types=1);

namespace App\Http\Requests;

use App\Models\FeeType;
use App\Models\Institution;
use App\Models\Promotion;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

final class FeeRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }


    public function rules(): array
    {
        return [
            'institution' => ['nullable', Rule::exists(Institution::class, 'id')],
            'promotion' => ['required', Rule::exists(Promotion::class, 'id')],
            'types' => ['required', Rule::exists(FeeType::class, 'id')],
            'amount' => ['required', 'integer', 'min:0'],
            'pay_date' => ['required', 'date', 'date_format:Y-m-d', 'after:today'],
            'description' => ['nullable', 'string', 'min:4']
        ];
    }
}
