<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SessionUpdateRequest extends FormRequest
{
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

    public function authorize(): bool
    {
        return true;
    }
}
