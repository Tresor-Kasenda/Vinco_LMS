<?php

declare(strict_types=1);

namespace App\Contracts;

use App\Services\ToastMessageService;

interface PromotionRepositoryInterface
{

    public function getPromotions();

    public function showPromotion(string $key);

    public function stored($attributes);

    public function updated(string $key, $attributes);

    public function deleted(string $key);

    public function changeStatus($attributes);
}
