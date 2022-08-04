<?php

declare(strict_types=1);

namespace App\Contracts\EnableX;

interface EnableXRepositoryInterface
{
    public function rooms();

    public function endRoom($attributes);

    public function inviteRoom($attributes);
}
