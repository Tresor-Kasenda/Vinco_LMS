<?php

declare(strict_types=1);

namespace App\Repositories\Backend;

use App\Contracts\FeesTypeRepositoryInterface;
use App\Models\FeeType;
use App\Traits\ImageUploader;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class FeesTypeRepository implements FeesTypeRepositoryInterface
{
    use ImageUploader;

    public function getFeesTypes(): Collection|array
    {
        return FeeType::query()
            ->select([
                'id',
                'name',
                'images'
            ])
            ->orderByDesc('created_at')
            ->get();
    }

    public function showFeeType(string $key): Model|Builder|null
    {
        return FeeType::query()
            ->select([
                'id',
                'name',
                'images'
            ])
            ->where('id', '=', $key)
            ->first();
    }

    public function stored($attributes, $factory): Model|Builder
    {
        $feeType = FeeType::query()
            ->create([
                'name' => $attributes->input('name'),
                'images' => self::uploadFiles($attributes),
            ]);
        $factory->addSuccess('Fees Type added with Successfully');

        return $feeType;
    }

    public function updated(string $key, $attributes, $factory): Model|Builder|null
    {
        $feeType = $this->showFeeType(key: $key);
        $this->removePathOfImages($feeType);
        $feeType->update([
            'name' => $attributes->input('name'),
            'images' => self::uploadFiles($attributes),
        ]);

        $factory->addSuccess('Fees Type updated with Successfully');

        return $feeType;
    }

    public function deleted(string $key, $factory): Model|Builder|null
    {
        $feeType = $this->showFeeType(key: $key);
        self::removePathOfImages($feeType);
        $feeType->delete();

        $factory->addSuccess('Fees Type deleted with Successfully');

        return $feeType;
    }
}
