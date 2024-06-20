<?php

namespace App\Listeners\Account;

use App\Enum\AccountStatusEnum;
use App\Enum\AccountTypeEnum;
use App\Events\CustomerAccountCreateEvent;
use App\Models\Account\Account;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class AccountCreateListener
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
    public function handle(CustomerAccountCreateEvent $event)

    {
        $customer=$event->customer;
      //  protected $fillable=["account_name","status","balance","account_type","initial_balance","account_owner"];
      $data=[
        "account_name"=>$customer->name,
        "status"=>AccountStatusEnum::ACTIVE->value,
        "balance"=>0,
        "account_type"=>AccountTypeEnum::CREDIT_ACCOUNT->value,
        "initial_balance"=>0,
        "account_owner"=>$customer->id,
      ];
      Account::create($data);

      //  dd($event);
    }
}
