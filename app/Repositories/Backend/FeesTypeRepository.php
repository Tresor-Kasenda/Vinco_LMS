<?php

declare(strict_types=1);

namespace App\Repositories\Backend;

use App\Contracts\FeesTypeRepositoryInterface;
use App\Models\FeeType;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

final class FeesTypeRepository implements FeesTypeRepositoryInterface
{
    public function getFeesTypes(): Collection|array
    {
        if (auth()->user()->hasRole('Super Admin')) {
            return FeeType::query()
                ->select([
                    'id',
                    'name',
                    'institution_id',
                ])
                ->with('institution')
                ->orderByDesc('created_at')
                ->get();
        }

        return FeeType::query()
            ->select([
                'id',
                'name',
                'institution_id',
            ])
            ->where('institution_id', '=', auth()->user()->institution->id)
            ->orderByDesc('created_at')
            ->get();
    }

    public function stored($attributes): Model|Builder
    {
        return FeeType::query()
            ->create([
                'name' => $attributes->input('name'),
                'institution_id' => $attributes->input('institution') ?? auth()->user()->institution->id,
            ]);
    }

    public function updated(string $key, $attributes): Model|Builder|null
    {
        $feeType = $this->showFeeType(key: $key);
        $feeType->update([
            'name' => $attributes->input('name'),
            'institution_id' => $attributes->input('institution') ?? auth()->user()->institution->id,
        ]);

        return $feeType;
    }

    public function showFeeType(string $key): Model|Builder|null
    {
        return FeeType::query()
            ->select([
                'id',
                'name',
                'institution_id',
            ])
            ->where('id', '=', $key)
            ->first();
    }

    public function deleted(string $key): Model|Builder|null
    {
        $feeType = $this->showFeeType(key: $key);
        $feeType->delete();
        return $feeType;
    }
}
