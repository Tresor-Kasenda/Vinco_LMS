<?php

namespace App\Repositories\EnableX;

use App\Contracts\EnableX\EnableXRepositoryInterface;
use App\Services\EnableX\EnableXService;
use App\Services\ToastMessageService;

final class EnableBackendRepository implements EnableXRepositoryInterface
{
    public function __construct(
        protected ToastMessageService $service,
        protected EnableXService $XService
    ) {
    }

    public function rooms()
    {
        // TODO: Implement rooms() method.
    }

    public function endRoom($attributes)
    {
        // TODO: Implement endRoom() method.
    }

    public function inviteRoom($attributes)
    {
        // TODO: Implement inviteRoom() method.
    }
}
