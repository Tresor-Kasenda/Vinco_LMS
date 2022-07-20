<?php

declare(strict_types=1);

namespace App\Repositories\Backend;

use App\Contracts\ExamSessionRepositoryInterface;
use App\Models\ExamSession;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class ExamSessionRepository implements ExamSessionRepositoryInterface
{
    public function getExamSessions(): array|Collection|\Illuminate\Support\Collection
    {
        return ExamSession::query()
            ->select([
                'id',
                'name',
                'start_date',
                'end_date',
                'note'
            ])
            ->orderByDesc('created_at')
            ->get();
    }

    public function showExamSession(string $key): Model|Builder|ExamSession|\Illuminate\Database\Query\Builder|null
    {
        return ExamSession::query()
            ->select([
                'id',
                'name',
                'start_date',
                'end_date',
                'note'
            ])
            ->where('id', '=', $key)
            ->first();
    }

    public function stored($attributes, $factory): Model|Builder|ExamSession
    {
        $examSession = ExamSession::query()
            ->create([
                'name' => $attributes->input('name'),
                'start_date' => $attributes->input("start_date"),
                'end_date' => $attributes->input('end_date'),
                'note' => $attributes->input('note')
            ]);
        $factory->addSuccess("New Exam Session as added with successfully");
        return $examSession;
    }

    public function updated(string $key, $attributes, $factory): Model|Builder|ExamSession|\Illuminate\Database\Query\Builder|null
    {
        $examSession = $this->showExamSession(key: $key);
        $examSession->update([
            'name' => $attributes->input('name'),
            'start_date' => $attributes->input("start_date"),
            'end_date' => $attributes->input('end_date'),
            'note' => $attributes->input('note')
        ]);
        $factory->addSuccess("New Exam Session as updated with successfully");
        return $examSession;
    }

    public function deleted(string $key, $factory): Model|Builder|ExamSession|\Illuminate\Database\Query\Builder|null
    {
        $examSession = $this->showExamSession(key: $key);
        $examSession->delete();

        $factory->addSuccess("New Exam Session as deleted with successfully");
        return $examSession;
    }
}
