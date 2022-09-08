<?php

declare(strict_types=1);

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendEmailToGuestMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public $roomId, public $date, public $startTime, public $endTime)
    {
    }

    public function build(): self
    {
        return $this
            ->subject('Invitation to an Aperi Online Session')
            ->view('mails.guests', [
                'roomId' => $this->roomId,
                'date' => $this->date,
                'startTime' => $this->startTime,
                'endTime'=>$this->endTime
            ]);
    }
}
