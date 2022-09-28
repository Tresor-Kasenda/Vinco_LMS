<?php

declare(strict_types=1);

namespace App\Repositories\Backend;

use App\Contracts\FeesTypeRepositoryInterface;
use App\Models\FeeType;
use App\Services\ToastMessageService;
use App\Traits\ImageUploader;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

final class FeesTypeRepository implements FeesTypeRepositoryInterface
{
    use ImageUploader;

    public function __construct(protected ToastMessageService $messageService)
    {
    }

    public function getFeesTypes(): Collection|array
    {
        if (auth()->user()->hasRole('Super Admin')) {
            return FeeType::query()
                ->select([
                    'id',
                    'name',
                    'images',
                    'institution_id'
                ])
                ->with('institution')
                ->orderByDesc('created_at')
                ->get();
        }
        return FeeType::query()
            ->select([
                'id',
                'name',
                'images',
                'institution_id'
            ])
            ->where('institution_id', '=', auth()->user()->institution->id)
            ->orderByDesc('created_at')
            ->get();
    }

    public function stored($attributes): Model|Builder
    {
        $feeType = FeeType::query()
            ->create([
                'name' => $attributes->input('name'),
                'images' => self::uploadFiles($attributes),
                'institution_id' => $attributes->input('institution') ?? auth()->user()->institution->id
            ]);
        $this->messageService->success("Fees Type added with Successfully");

        return $feeType;
    }

    public function updated(string $key, $attributes): Model|Builder|null
    {
        $feeType = $this->showFeeType(key: $key);
        $this->removePathOfImages($feeType);
        $feeType->update([
            'name' => $attributes->input('name'),
            'images' => self::uploadFiles($attributes),
            'institution_id' => $attributes->input('institution') ?? auth()->user()->institution->id
        ]);
        $this->messageService->success("Fees Type updated with Successfully");

        return $feeType;
    }

    public function showFeeType(string $key): Model|Builder|null
    {
        return FeeType::query()
            ->select([
                'id',
                'name',
                'images',
                'institution_id'
            ])
            ->where('id', '=', $key)
            ->first();
    }

    public function deleted(string $key): Model|Builder|null
    {
        $feeType = $this->showFeeType(key: $key);
        self::removePathOfImages($feeType);
        $feeType->delete();
        $this->messageService->success("Fees Type deleted with Successfully");

        return $feeType;
    }
}
