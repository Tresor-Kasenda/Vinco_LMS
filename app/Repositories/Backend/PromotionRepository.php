<?php

declare(strict_types=1);

namespace App\Repositories\Backend;

use App\Contracts\PromotionRepositoryInterface;
use App\Enums\StatusEnum;
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
            ->with(['subsidiary', 'students', 'academic'])
            ->orderByDesc('created_at')
            ->get();
    }

    public function showPromotion(string $key): Model|Builder|Promotion
    {
        $promotion = Promotion::query()
            ->where('key', '=', $key)
            ->firstOrCreate();
        return $promotion->load(['subsidiary', 'academic']);
    }

    public function stored($attributes, $factory): Model|Builder|Promotion|RedirectResponse
    {
        $promotion = Promotion::query()
            ->when('subsidiary_id', function ($query) use ($attributes) {
                $query->where('subsidiary_id', $attributes->input('filiaire'));
            })
            ->first();
        if (! $promotion) {
            $faculty = Promotion::query()
                ->create([
                    'subsidiary_id' => $attributes->input('filiaire'),
                    'name' => $attributes->input('name'),
                    'description' => $attributes->input('description'),
                    'images' => self::uploadFiles($attributes),
                    'academic_year_id' => $attributes->input('academic')
                ]);
            $factory->addSuccess('Une mouvelle filiaire a ete ajouter');

            return $faculty;
        }
        $factory->addError('Le responsable choisie a ete deja affecter dans un autre campus');

        return back();
    }

    public function updated(string $key, $attributes, $factory): Model|Builder|Promotion
    {
        $promotion = $this->showPromotion(key: $key);
        $this->removePathOfImages($promotion);
        $promotion->update([
            'subsidiary_id' => $attributes->input('filiaire'),
            'name' => $attributes->input('name'),
            'description' => $attributes->input('description'),
            'images' => self::uploadFiles($attributes),
            'academic_year_id' => $attributes->input('academic')
        ]);
        $factory->addSuccess('Un campus a ete modifier');

        return $promotion;
    }

    public function deleted(string $key, $factory): RedirectResponse
    {
        $promotion = $this->showPromotion(key: $key);
        if ($promotion->status !== StatusEnum::FALSE) {
            $factory->addError('Veillez desactiver avant de le mettre dans la corbeille');

            return back();
        }
        $promotion->delete();
        $factory->addSuccess('Un campus a ete modifier');

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
