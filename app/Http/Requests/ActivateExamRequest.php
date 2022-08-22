<?php

namespace App\Http\Requests;

use App\Models\Exam;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

final class ActivateExamRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'status' => ['required'],
            'key' => ['required', Rule::exists(Exam::class, 'id')],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
