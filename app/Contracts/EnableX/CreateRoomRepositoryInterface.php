<?php

declare(strict_types=1);

namespace App\Contracts\EnableX;

interface CreateRoomRepositoryInterface
{
    public function createRooms($attributes);
}
