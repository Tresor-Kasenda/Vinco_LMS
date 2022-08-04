<?php

declare(strict_types=1);

namespace App\States;

class Inactive extends ActivationState
{
    public function color(): string
    {
        return  'danger';
    }
}
