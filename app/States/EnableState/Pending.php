<?php

declare(strict_types=1);

namespace App\States\EnableState;

class Pending extends ActivateRoomState
{
    public function status(): bool
    {
        return false;
    }
}
