<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class GeneralNotification extends Notification
{
    use Queueable;

    private $data;

    public function __construct($data)
    {
        $this->data = json_decode($data);;
    }

    public function via(object $notifiable): array
    {
        return ['database'];
    }

    public function toDatabase(object $notifiable): array
    {
        return [
            'title' => $this->data->title,
            'description' => $this->data->description,
        ];
    }

    public function databaseType(object $notifiable): string
    {
        return 'general';
    }
}
