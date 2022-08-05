<?php

declare(strict_types=1);

namespace App\States;

final class Inactive extends ActivationState
{
    public function color(): string
    {
        return  'danger';
    }
}
