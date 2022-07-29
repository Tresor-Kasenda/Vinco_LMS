<?php

declare(strict_types=1);

namespace App\Services;

use Illuminate\Contracts\Queue\ShouldQueue;

class SendEmailConfirmation implements ShouldQueue
{
    public function send($user)
    {
        return [];
    }
}
