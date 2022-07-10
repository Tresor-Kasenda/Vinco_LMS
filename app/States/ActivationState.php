<?php

declare(strict_types=1);

namespace App\States;

use Spatie\ModelStates\Attributes\AllowTransition;
use Spatie\ModelStates\Attributes\DefaultState;
use Spatie\ModelStates\State;

#[
    DefaultState(Inactive::class),
    AllowTransition(Inactive::class, Active::class)
]
abstract class ActivationState extends State
{
    abstract public function color(): string;
}
