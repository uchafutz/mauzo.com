<?php

namespace App\Listeners;

use App\Events\UserCreated;
use App\Mail\UserCreatedMail;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Nette\Utils\Random;

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
      
        User::create([
            'name'=>$event->name,
            "email"=>$event->email,
            "password"=>Random::generate(),

        ]);
        Mail::to($event->email)->send(new UserCreatedMail());
        

    }
}
