<?php

declare(strict_types=1);

namespace App\Repositories\Backend;

use App\Contracts\AcademicYearRepositoryInterface;
use App\Models\AcademicYear;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class AcademicYearRepository implements AcademicYearRepositoryInterface
{
    public function getAcademicsYears(): Collection|array
    {
        return AcademicYear::query()
            ->latest()
            ->get();
    }

    public function showAcademicYear(string $key): Model|Builder|null
    {
        return AcademicYear::query()
            ->where('key', '=', $key)
            ->first();
    }

    public function stored($attributes, $flash): Model|Builder
    {
        $academic = AcademicYear::query()
            ->create([
                'start_date' => $attributes->input('startDate'),
                'end_date' => $attributes->input('endDate'),
            ]);
        $flash->addSuccess('Une nouvelle annee a ete ajouter');

        return $academic;
    }

    public function updated(string $key, $attributes, $flash): Model|Builder|null
    {
        $academic = $this->showAcademicYear(key: $key);
        $academic->update([
            'startDate' => $attributes->input('startDate'),
            'endDate' => $attributes->input('endDate'),
        ]);
        $flash->addSuccess('l\'annee academique a ete modifier');

        return $academic;
    }

    public function deleted(string $key, $flash): Model|Builder|null
    {
        $academic = $this->showAcademicYear(key: $key);
        $academic->delete();
        $flash->addSuccess('l\'annee academique a ete supprimer');

        return $academic;
    }
}
