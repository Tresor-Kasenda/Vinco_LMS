<?php

declare(strict_types=1);

namespace App\Contracts;

interface PromotionRepositoryInterface
{
    public function getPromotions();

    public function showPromotion(string $key);

    public function stored($attributes);

    public function updated(string $key, $attributes);

    public function deleted(string $key);

    public function changeStatus($attributes);
}
