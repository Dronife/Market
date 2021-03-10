<?php

namespace App\Listeners;
use App\Models\User;
use App\Notifications\ItemCreated;
use Illuminate\Support\Facades\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendCheapestItemNotification
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        $allUsers = User::get();
        Notification::send($allUsers, new ItemCreated($event->item));
    }
}
