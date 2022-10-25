<?php

declare(strict_types=1);

namespace App\Repositories\Backend;

use App\Contracts\ExamSessionRepositoryInterface;
use App\Models\ExamSession;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

final class ExamSessionRepository implements ExamSessionRepositoryInterface
{
    public function getExamSessions(): array|Collection|\Illuminate\Support\Collection
    {
        return ExamSession::query()
            ->select([
                'id',
                'name',
                'start_date',
                'end_date',
            ])
            ->orderByDesc('created_at')
            ->get();
    }

    public function stored($attributes): Model|Builder|ExamSession
    {
        $examSession = ExamSession::query()
            ->create([
                'name' => $attributes->input('name'),
                'start_date' => $attributes->input('start_date'),
                'end_date' => $attributes->input('end_date'),
            ]);

        return $examSession;
    }

    public function updated(string $key, $attributes): Model|Builder|ExamSession|\Illuminate\Database\Query\Builder|null
    {
        $examSession = $this->showExamSession(key: $key);
        $examSession->update([
            'name' => $attributes->input('name'),
            'start_date' => $attributes->input('start_date'),
            'end_date' => $attributes->input('end_date'),
        ]);

        return $examSession;
    }

    public function showExamSession(string $key): Model|Builder|ExamSession|\Illuminate\Database\Query\Builder|null
    {
        return ExamSession::query()
            ->select([
                'id',
                'name',
                'start_date',
                'end_date',
            ])
            ->where('id', '=', $key)
            ->first();
    }

    public function deleted(string $key): Model|Builder|ExamSession|\Illuminate\Database\Query\Builder|null
    {
        $examSession = $this->showExamSession(key: $key);
        $examSession->delete();

        return $examSession;
    }
}
