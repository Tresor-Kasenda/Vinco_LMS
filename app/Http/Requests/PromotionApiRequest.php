<?php

declare(strict_types=1);

namespace App\Http\Requests;

use App\Models\Subsidiary;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use JetBrains\PhpStorm\ArrayShape;

final class PromotionApiRequest extends FormRequest
{
    #[ArrayShape(['filiaire' => 'array'])]
    public function rules(): array
    {
        return [
            'filiaire' => ['required', Rule::exists(Subsidiary::class, 'id')],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
