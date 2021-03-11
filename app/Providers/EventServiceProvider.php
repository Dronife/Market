<?php

namespace App\Providers;


use App\Listeners\SendItemNotifications;
use Illuminate\Auth\Events\Registered;
use App\Events\CreatedNewCheapestItem;
use App\Events\ItemControlEvent;
use App\Listeners\SendCheapestItemNotification;
use App\Listeners\UpdateItemTable;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        CreatedNewCheapestItem::class => [
            SendCheapestItemNotification::class,
        ],
    ];
    public function boot()
    {
        
    }
    
    public function shouldDiscoverEvents()
    {
        return true;
    }
}
