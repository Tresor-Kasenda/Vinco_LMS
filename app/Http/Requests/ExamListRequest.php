<?php

namespace App\Http\Requests;

use App\Models\Course;
use App\Models\ExamSession;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ExamListRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'course' => ['required', Rule::exists(Course::class, 'id')],
            'exam_session' => ['required', Rule::exists(ExamSession::class, 'id')],
            'rating' => ['required', 'integer'],
            'date' => ['required', 'date'],
            'start_time' => ['required'],
            'duration' => ['required', 'string']
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
