<?php

declare(strict_types=1);

namespace App\Contracts\EnableX;

interface CreateTokenRepositoryInterface
{
    public function createToken($attributes);
}
