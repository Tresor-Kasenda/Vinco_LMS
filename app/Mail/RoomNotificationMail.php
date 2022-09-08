<?php

declare(strict_types=1);

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class RoomNotificationMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public $roomId, public $date, public $startTime, public $endTime)
    {
    }

    public function build(): self
    {
        return $this
            ->subject('Confirmation of an APERI Online Session Creation!')
            ->view('mails.index', [
                'roomId' => $this->roomId,
                'date' => $this->date,
                'startTime' => $this->startTime,
                'endTime'=>$this->endTime
            ]);
    }
}
