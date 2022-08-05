<?php

declare(strict_types=1);

namespace App\States\EnableState;

final class Confirmed extends ActivateRoomState
{
    public function status(): bool
    {
        return true;
    }
}
