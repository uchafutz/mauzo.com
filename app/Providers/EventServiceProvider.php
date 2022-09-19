<?php

namespace App\Providers;

use App\Events\PurchaseSubmited;
use App\Events\UserCreated;
use App\Listeners\PurchaseSubmited\CreateStockItem;
use App\Listeners\PurchaseSubmited\CreateStockTransaction;
use App\Listeners\UserAccountCreated;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event to listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
       UserCreated::class=>[
        UserAccountCreated::class,
         ],
         PurchaseSubmited::class => [
            CreateStockItem::class,
            CreateStockTransaction::class,
         ]
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     *
     * @return bool
     */
    public function shouldDiscoverEvents()
    {
        return false;
    }
}
