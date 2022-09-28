<?php

declare(strict_types=1);

namespace App\States;

final class Active extends ActivationState
{
    public function color(): string
    {
        return 'primary';
    }

    public function getClassName(): string
    {
        return self::class;
    }
}
