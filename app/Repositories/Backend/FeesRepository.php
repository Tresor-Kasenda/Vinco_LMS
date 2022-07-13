<?php

declare(strict_types=1);

namespace App\Repositories\Backend;

use App\Contracts\FeesRepositoryInterface;
use App\Enums\StatusEnum;
use App\Models\Fee;
use App\Traits\RandomValues;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class FeesRepository implements FeesRepositoryInterface
{
    use RandomValues;

    public function getFees(): Collection|array
    {
        return Fee::query()
            ->select([
                'student_id',
                'fee_type_id',
                'amount',
                'due_date',
                'status',
            ])
            ->with(['student', 'feeType'])
            ->orderByDesc('created_at')
            ->get();
    }

    public function showFee(int $key)
    {
        $fee = Fee::query()
            ->find($key)
            ->first();

        return $fee->load(['student', 'feeType']);
    }

    public function stored($attributes, $factory): Model|Builder
    {
        $fee = Fee::query()
            ->create([
                'fee_type_id' => $attributes->input('type'),
                'student_id' => $attributes->input('student'),
                'amount' => $attributes->input('amount'),
                'name' => $attributes->input('name'),
                'transaction_no' => self::generateStringValues(0, 9999999999),
                'due_date' => $attributes->input('dues'),
                'pay_date' => $attributes->input('pay_date'),
                'description' => $attributes->input('description'),
                'status' => StatusEnum::FALSE,
                'institution_id' => $attributes->input('institution'),
            ]);

        $factory->addSuccess('Fee added with successfully');

        return $fee;
    }

    public function updated(int $key, $attributes, $factory)
    {
        $fee = $this->showFee(key: $key);
        $fee->update([
            'fee_type_id' => $attributes->input('type'),
            'student_id' => $attributes->input('student'),
            'amount' => $attributes->input('amount'),
            'name' => $attributes->input('name'),
            'due_date' => $attributes->input('dues'),
            'pay_date' => $attributes->input('pay_date'),
            'description' => $attributes->input('description'),
            'institution_id' => $attributes->input('institution'),
        ]);

        $factory->addSuccess('Fee updated with successfully');

        return $fee;
    }

    public function deleted(int $key, $factory)
    {
        $fee = $this->showFee(key: $key);
        $fee->delete();

        $factory->addSuccess('Fee deleted with successfully');

        return $fee;
    }
}
