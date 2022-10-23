<?php

declare(strict_types=1);

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class InstitutionNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public function __construct(public $institution)
    {
        //
    }

    public function via($notifiable): array
    {
        return ['database', 'mail'];
    }

    public function toMail($notifiable): MailMessage
    {
        return (new MailMessage())
                    ->line('The introduction to the notification.')
                    ->action('Notification Action', url('/'))
                    ->line('Thank you for using our application!');
    }

    public function toArray($notifiable): array
    {
        return [
            'name' => $this->institution->institution_name,
            'email' => $this->institution->institution_email,
            'phones' => $this->institution->institution_phones,
        ];
    }
}
