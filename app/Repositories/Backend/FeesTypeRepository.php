<?php

declare(strict_types=1);

namespace App\Repositories\Backend;

use App\Contracts\FeesTypeRepositoryInterface;
use App\Models\FeeType;
use App\Models\IncomeType;
use App\Traits\ImageUploader;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class FeesTypeRepository implements FeesTypeRepositoryInterface
{
    use ImageUploader;

    public function getFeesTypes(): Collection|array
    {
        return FeeType::query()
            ->orderByDesc('created_at')
            ->get();
    }

    public function showFeeType(string $key): Model|Builder|null
    {
        return FeeType::query()
            ->where('id', '=', $key)
            ->first();
    }

    public function stored($attributes, $factory): Model|Builder
    {
        $fee = FeeType::query()
            ->create([
                'name' => $attributes->input('name'),
                'images' => self::uploadFiles($attributes),
            ]);
        $factory->addSuccess('Une nouvelle fees type a ete ajouter');

        return $fee;
    }

    public function updated(string $key, $attributes, $factory): Model|Builder|null
    {
        $fee = $this->showFeeType(key: $key);
        $this->removePathOfImages($fee);
        $fee->update([
            'name' => $attributes->input('name'),
            'images' => self::uploadFiles($attributes),
        ]);
        $factory->addSuccess('Nouvelle fees type a ete mise a jours avec success');

        return $fee;
    }

    public function deleted(string $key, $factory): Model|Builder|null
    {
        $fee = $this->showFeeType(key: $key);
        self::removePathOfImages($fee);
        $fee->delete();
        $factory->addSuccess('Nouvelle fees type a ete supprimer avec success');

        return $fee;
    }
}
