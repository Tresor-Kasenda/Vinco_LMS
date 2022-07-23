<?php

declare(strict_types=1);

namespace App\Repositories\Backend;

use App\Contracts\AcademicYearRepositoryInterface;
use App\Models\AcademicYear;
use App\Services\ToastMessageService;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class SessionRepository implements AcademicYearRepositoryInterface
{
    public function __construct(public ToastMessageService $service)
    {
    }

    public function getAcademicsYears(): Collection|array
    {
        if (\Auth::user()->institution != null) {
            return AcademicYear::query()
                ->where('institution_id', '=', \Auth::user()->institution->id)
                ->get();
        } else {
            return AcademicYear::query()
                ->where('institution_id', '=', 'A')
                ->get();
        }
    }

    public function showAcademicYear(string $key): Model|Builder|null
    {
        return AcademicYear::query()
            ->where('id', '=', $key)
            ->first();
    }

    public function stored($attributes, $flash): Model|Builder
    {
        $academic = AcademicYear::query()
            ->create([
                'institution_id' => \Auth::user()->institution->id,
                'start_date' => $attributes->input('startDate'),
                'end_date' => $attributes->input('endDate'),
            ]);
        $this->service->success('Une nouvelle annee a ete ajouter');
        return $academic;
    }

    public function updated(string $key, $attributes, $flash): Model|Builder|null
    {
        $academic = $this->showAcademicYear(key: $key);
        $academic->update([
            'start_date' => $attributes->input('startDate'),
            'end_date' => $attributes->input('endDate'),
        ]);
        $this->service->success("l'annee academique a ete modifier");
        return $academic;
    }

    public function deleted(string $key, $flash): Model|Builder|null
    {
        $academic = $this->showAcademicYear(key: $key);
        $academic->delete();

        $this->service->success("l'annee academique a ete supprimer");
        return $academic;
    }
}
