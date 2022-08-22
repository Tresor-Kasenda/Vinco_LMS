<?php

declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

final class SessionRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'startDate' => [
                'required',
                'date',
                'date_format:Y-m-d',
                'before:endDate',
            ],
            'endDate' => [
                'required',
                'date',
                'date_format:Y-m-d',
                'after:startDate',
            ],
        ];
    }
}
