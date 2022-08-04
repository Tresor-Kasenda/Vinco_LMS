<?php

declare(strict_types=1);

namespace App\Repositories\Backend;

use App\Contracts\ExamListRepositoryInterface;
use App\Enums\StatusEnum;
use App\Http\Requests\ActivateExamRequest;
use App\Models\Exam;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use LaravelIdea\Helper\App\Models\_IH_Exam_QB;

class ExamListRepository implements ExamListRepositoryInterface
{
    public function exams(): array|Collection
    {
        return Exam::query()
            ->select([
                'id',
                'course_id',
                'rating',
                'date',
                'duration',
                'exam_session_id',
            ])
            ->with('course:id,name', 'examSession:id,name')
            ->orderByDesc('created_at')
            ->get();
    }

    public function showExam(string $key): Model|Exam|Builder|\Illuminate\Database\Query\Builder
    {
        $exam = Exam::query()
            ->select([
                'id',
                'course_id',
                'rating',
                'date',
                'duration',
                'status',
                'exam_session_id',
            ])
            ->where('id', '=', $key)
            ->firstOrFail();

        return $exam->load('course:id,name,professor_id,images', 'examSession:id,name');
    }

    public function stored($attributes, $factory): Model|Exam|_IH_Exam_QB|Builder
    {
        $exam = Exam::query()
            ->create([
                'course_id' => $attributes->input('course'),
                'rating' => $attributes->input('rating'),
                'date' => $attributes->input('date'),
                'duration' => $attributes->input('duration'),
                'start_time' => $attributes->input('start_time'),
                'exam_session_id' => $attributes->input('exam_session'),
                'status' => StatusEnum::FALSE,
            ]);
        $factory->addSuccess('New exam list as added with successfully');

        return $exam;
    }

    public function updated(string $key, $attributes, $factory): Model|Exam|Builder|\Illuminate\Database\Query\Builder
    {
        $exam = $this->showExam(key: $key);
        $exam->update([
            'course_id' => $attributes->input('course'),
            'rating' => $attributes->input('rating'),
            'date' => $attributes->input('date'),
            'duration' => $attributes->input('duration'),
            'exam_session_id' => $attributes->input('exam_session'),
            'start_time' => $attributes->input('start_time'),
        ]);

        $factory->addSuccess('New exam list as updated with successfully');

        return $exam;
    }

    public function deleted(string $key, $factory): Model|Exam|Builder|\Illuminate\Database\Query\Builder
    {
        $exam = $this->showExam(key: $key);

        $exam->delete();

        $factory->addSuccess('New exam list as deleted with successfully');

        return $exam;
    }

    public function activate(ActivateExamRequest $request): Model|Exam|Builder|\Illuminate\Database\Query\Builder
    {
        $exam = $this->showExam($request->input('key'));

        $exam->update([
            'status' => $request->input('status'),
        ]);

        return $exam;
    }
}
