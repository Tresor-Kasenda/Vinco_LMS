<?php

declare(strict_types=1);

namespace App\States\EnableState;

use Spatie\ModelStates\Attributes\AllowTransition;
use Spatie\ModelStates\Attributes\DefaultState;
use Spatie\ModelStates\State;

#[
    DefaultState(Pending::class),
    AllowTransition(Pending::class, Confirmed::class)
]
abstract class ActivateRoomState extends State
{
    abstract public function status(): bool;
}
