<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\Institution;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Mail;

class EmailInstitutionService implements ShouldQueue
{
    public function sendEmail(Institution $institution)
    {
        $data = ['name' => $institution->institution_name];

        return Mail::send('mail.institution.register', $data, function ($message) use ($institution) {
            $message->to(
                $institution->institution_email,
                $institution->institution_name
            )->subject('Institution Register');
            $message->from('institution@vinco.digital', 'Vinco Education');
        });
    }
}
