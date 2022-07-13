<?php

declare(strict_types=1);

namespace App\Repositories\Backend;

use App\Contracts\PromotionRepositoryInterface;
use App\Models\Promotion;
use App\Traits\ImageUploader;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\RedirectResponse;

class PromotionRepository implements PromotionRepositoryInterface
{
    use ImageUploader;

    public function getPromotions(): array|Collection|\Illuminate\Support\Collection
    {
        return Promotion::query()
            ->select([
                'id',
                'name',
                'images',
                'academic_year_id',
                'subsidiary_id',
            ])
            ->with(['subsidiary:id,name', 'academic:id,start_date,end_date'])
            ->orderByDesc('created_at')
            ->get();
    }

    public function showPromotion(string $key): Model|Builder|Promotion
    {
        $promotion = Promotion::query()
            ->select([
                'id',
                'name',
                'images',
                'academic_year_id',
                'subsidiary_id',
            ])
            ->where('id', '=', $key)
            ->firstOrCreate();

        return $promotion->load(['subsidiary:id,name,department_id', 'academic:id,start_date,end_date']);
    }

    public function stored($attributes, $factory): Model|Builder|Promotion|RedirectResponse
    {
        $faculty = Promotion::query()
            ->create([
                'subsidiary_id' => $attributes->input('filiaire'),
                'name' => $attributes->input('name'),
                'description' => $attributes->input('description'),
                'images' => self::uploadFiles($attributes),
                'academic_year_id' => $attributes->input('academic'),
            ]);
        $factory->addSuccess('Une mouvelle promotion a ete ajouter');

        return $faculty;
    }

    public function updated(string $key, $attributes, $factory): Model|Builder|Promotion
    {
        $promotion = $this->showPromotion(key: $key);

        $promotion->update([
            'subsidiary_id' => $attributes->input('filiaire'),
            'name' => $attributes->input('name'),
            'description' => $attributes->input('description'),
            'academic_year_id' => $attributes->input('academic'),
        ]);

        $factory->addSuccess('Promotion updated with successfully');

        return $promotion;
    }

    public function deleted(string $key, $factory): RedirectResponse
    {
        $promotion = $this->showPromotion(key: $key);
        $promotion->delete();
        $factory->addSuccess('Promotion trashed with successfully');

        return back();
    }

    public function changeStatus($attributes): bool|int
    {
        $promotion = $this->showPromotion(key: $attributes->input('key'));
        if ($promotion != null) {
            return $promotion->update([
                'status' => $attributes->input('status'),
            ]);
        }

        return false;
    }
}
