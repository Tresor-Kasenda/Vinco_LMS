<?php

declare(strict_types=1);

namespace App\Repositories\Backend;

use App\Contracts\PromotionRepositoryInterface;
use App\Models\Promotion;
use App\Services\ToastMessageService;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\RedirectResponse;

final class PromotionRepository implements PromotionRepositoryInterface
{
    public function __construct(protected ToastMessageService $service)
    {
    }

    public function getPromotions(): array|Collection|\Illuminate\Support\Collection
    {
        if (auth()->user()->hasRole('Super Admin')) {
            return Promotion::query()
                ->select([
                    'id',
                    'name',
                    'academic_year_id',
                    'subsidiary_id',
                ])
                ->with([
                    'academic:id,start_date,end_date',
                    'subsidiary:id,department_id,name' => [
                        'department:id,campus_id' => [
                            'campus:id,institution_id' => [
                                'institution:id,institution_name',
                            ],
                        ],
                    ],
                ])
                ->orderByDesc('created_at')
                ->get();
        }

        return Promotion::query()
            ->select([
                'id',
                'name',
                'academic_year_id',
                'subsidiary_id',
            ])
            ->with(['subsidiary:id,name', 'academic:id,start_date,end_date'])
            ->whereHas('subsidiary', function ($builder) {
                $builder->whereHas('user', function ($builder) {
                    $builder->where('institution_id', auth()->user()->institution->id);
                });
            })
            ->orderByDesc('created_at')
            ->get();
    }

    public function showPromotion(string $key): Model|Builder|Promotion
    {
        $promotion = Promotion::query()
            ->select([
                'id',
                'name',
                'academic_year_id',
                'subsidiary_id',
            ])
            ->where('id', '=', $key)
            ->firstOrFail();

        return $promotion->load(['subsidiary:id,name,department_id', 'academic:id,start_date,end_date']);
    }

    public function stored($attributes): Model|Builder|Promotion|RedirectResponse
    {
        $faculty = Promotion::query()
            ->create([
                'subsidiary_id' => $attributes->input('filiaire'),
                'name' => $attributes->input('name'),
                'description' => $attributes->input('description'),
                'academic_year_id' => $attributes->input('academic'),
            ]);
        $this->service->success('Promotion added with successfully');

        return $faculty;
    }

    public function updated(string $key, $attributes): Model|Builder|Promotion
    {
        $promotion = $this->showPromotion(key: $key);

        $promotion->update([
            'subsidiary_id' => $attributes->input('filiaire'),
            'name' => $attributes->input('name'),
            'description' => $attributes->input('description'),
            'academic_year_id' => $attributes->input('academic'),
        ]);

        $this->service->success('Promotion updated with successfully');

        return $promotion;
    }

    public function deleted(string $key): RedirectResponse
    {
        $promotion = $this->showPromotion(key: $key);
        $promotion->delete();
        $this->service->success('Promotion trashed with successfully');

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
