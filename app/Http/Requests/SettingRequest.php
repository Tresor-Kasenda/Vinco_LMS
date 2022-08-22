<?php

declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

final class SettingRequest extends FormRequest
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
            'app_name' => ['required', 'min:3', 'string'],
            'short_name' => ['nullable', 'min:3', 'string'],
            'app_email' => ['required', 'string', 'email', 'regex:/(.+)@(.+)\.(.+)/i'],
            'app_phone' => ['nullable', 'min:10', 'regex:/^([0-9\s\-\+\(\)]*)$/'],
            'app_address' => ['nullable', 'min:3', 'string'],
            'app_icons' => ['required', 'image', 'mimes:ico,png,svg'],
            'app_images' => ['required', 'image', 'mimes:jpg,png,svg,gif,jpeg'],
        ];
    }
}
