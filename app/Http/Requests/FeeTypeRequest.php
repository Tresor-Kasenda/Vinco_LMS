<?php

declare(strict_types=1);

namespace App\Http\Requests;

use App\Models\Institution;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

final class FeeTypeRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'min:3'],
            'images' => ['required', 'image', 'mimes:jpg,png,svg,gif,jpeg'],
            'institution' => ['nullable', Rule::exists(Institution::class, 'id')]
        ];
    }
}
