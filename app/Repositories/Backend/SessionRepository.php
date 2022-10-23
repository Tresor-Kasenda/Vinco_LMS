<?php

declare(strict_types=1);

namespace App\Repositories\Backend;

use App\Contracts\AcademicYearRepositoryInterface;
use App\Models\AcademicYear;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

final class SessionRepository implements AcademicYearRepositoryInterface
{
    public function getAcademicsYears(): Collection|array
    {
        if (\Auth::user()->hasRole('Super Admin')) {
            return AcademicYear::query()
                ->select([
                    'id',
                    'start_date',
                    'end_date',
                ])
                ->orderByDesc('created_at')
                ->get();
        }

        return AcademicYear::query()
            ->select([
                'id',
                'start_date',
                'end_date',
                'institution_id',
            ])
            ->where('institution_id', '=', auth()->user()->institution_id)
            ->get();
    }

    public function stored($attributes): Model|Builder
    {
        return AcademicYear::query()
            ->create([
                'institution_id' => \Auth::user()->institution->id,
                'start_date' => $attributes->input('startDate'),
                'end_date' => $attributes->input('endDate'),
            ]);
    }

    public function updated(int $academic, $attributes): Model|Builder|null
    {
        $session = $this->show(academic: $academic);
        $session->update([
            'start_date' => $attributes->input('startDate'),
            'end_date' => $attributes->input('endDate'),
        ]);

        return $session;
    }

    public function show(int $academic)
    {
        return AcademicYear::query()
            ->where('id', '=', $academic)
            ->first();
    }

    public function deleted(int $academic): Model|Builder|null
    {
        $session = $this->show(academic: $academic);
        $session->delete();
        return $session;
    }
}
