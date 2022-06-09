<?php

declare(strict_types=1);

namespace App\Contracts;

interface PromotionRepositoryInterface
{
    public function getPromotions();

    public function showPromotion(string $key);

    public function stored($attributes, $factory);

    public function updated(string $key, $attributes, $factory);

    public function deleted(string $key, $factory);

    public function changeStatus($attributes);
}
