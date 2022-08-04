<?php

declare(strict_types=1);

namespace App\Http\Requests;

use App\Models\Institution;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use JetBrains\PhpStorm\ArrayShape;

class ProfessorApiRequest extends FormRequest
{
    #[ArrayShape(['institution' => 'array'])]
    public function rules(): array
    {
        return [
            'institution' => ['required', Rule::exists(Institution::class, 'id')],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
