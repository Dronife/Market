<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ItemCreated extends Notification
{
    use Queueable;

    
    public function __construct($item)
    {
        $this->item = $item;
    }

    
    public function via($notifiable)
    {
        return [ 'database'];
    }


    public function toArray($notifiable)
    {
        return [
            'name' => $this->item->name,
            'price' => $this->item->price,

        ];
        
    }
}
