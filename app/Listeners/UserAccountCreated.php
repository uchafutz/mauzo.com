<?php

namespace App\Listeners;

use App\Events\UserCreated;
use App\Mail\UserCreatedMail;
use App\Notifications\UserCreatedNotification;
use Illuminate\Support\Facades\Mail;

class UserAccountCreated
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
    public function handle(UserCreated $event)
    {

        //Mail::to($user->email)->send(new UserCreatedMail());
        
        
        //UserCreatedNotification

    }
}
