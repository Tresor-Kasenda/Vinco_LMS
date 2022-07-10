<?php

declare(strict_types=1);

namespace App\Http\Requests;

use App\Models\Chapter;
use App\Models\Lesson;
use App\Models\Resource;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ResourceRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
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
    public function rules()
    {
        return [
            'name' => ['required', 'string', 'min:3', Rule::unique(Resource::class, 'name')],
            'chapter' => ['required', Rule::exists(Chapter::class, 'id')],
            'lesson' => ['required', Rule::exists(Lesson::class, 'id')],
            'files' => ['required', 'mimes:png,jpg,jpeg,csv,txt,xlx,xls,pdf,sgv'],
        ];
    }
}
