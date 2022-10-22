<?php

declare(strict_types=1);

namespace App\Repositories\Backend;

use App\Contracts\FeesRepositoryInterface;
use App\Models\Fee;
use App\Services\ToastMessageService;
use App\Traits\RandomValue;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

final class FeesRepository implements FeesRepositoryInterface
{
    use RandomValue;

    public function __construct(protected ToastMessageService $toastMessage)
    {
    }

    public function getFees(): Collection|array
    {
        if (auth()->user()->hasRole('Super Admin')) {
            return Fee::query()
                ->select([
                    'id',
                    'fee_type_id',
                    'amount',
                    'pay_date',
                    'institution_id',
                    'promotion_id',
                ])
                ->with(['feeType', 'institution'])
                ->orderByDesc('created_at')
                ->get();
        }

        return Fee::query()
            ->select([
                'id',
                'fee_type_id',
                'amount',
                'pay_date',
                'institution_id',
                'promotion_id',
            ])
            ->where('institution_id', '=', auth()->user()->institution->id)
            ->with('feeType')
            ->orderByDesc('created_at')
            ->get();
    }

    public function stored($attributes): Model|Builder
    {
        $fee = Fee::query()
            ->create([
                'fee_type_id' => $attributes->input('types'),
                'amount' => $attributes->input('amount'),
                'pay_date' => $attributes->input('pay_date'),
                'description' => $attributes->input('description'),
                'institution_id' => $attributes->input('institution') ?? auth()->user()->institution->id,
                'promotion_id' => $attributes->input('promotion'),
            ]);
        $this->toastMessage->success('Fee added with successfully');

        return $fee;
    }

    public function updated(int $key, $attributes)
    {
        $fee = $this->showFee(key: $key);
        $fee->update([
            'fee_type_id' => $attributes->input('type'),
            'amount' => $attributes->input('amount'),
            'pay_date' => $attributes->input('pay_date'),
            'description' => $attributes->input('description'),
            'institution_id' => $attributes->input('institution') ?? auth()->user()->institution->id,
            'promotion_id' => $attributes->input('promotion'),
        ]);
        $this->toastMessage->success('Fee updated with successfully');

        return $fee;
    }

    public function showFee(int $key)
    {
        $fee = Fee::query()
            ->select([
                'id',
                'amount',
                'pay_date',
                'description',
                'description',
                'promotion_id',
                'institution_id',
            ])
            ->find($key)
            ->first();

        return $fee->load(['feeType:id,name,images', 'institution:id,institution_name', 'promotion:id,name']);
    }

    public function deleted(int $key)
    {
        $fee = $this->showFee(key: $key);
        $fee->delete();
        $this->toastMessage->success('Fee deleted with successfully');

        return $fee;
    }
}
