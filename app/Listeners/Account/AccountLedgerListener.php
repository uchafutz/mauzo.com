<?php

namespace App\Listeners\Account;

use App\Models\Account\Account;
use App\Models\Account\AccountLedger;
use Exception;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class AccountLedgerListener
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
        
       // "account_id","description", "amount","credit","debit","date","sale_id"
       $sale = $event->sale;

       // Ensure $sale is retrieved correctly
       if (!$sale) {
           throw new Exception("Sale not found in event.");
       }
       
       // Check if the sale is on credit
       if ($sale->oncredit === 1) {
           // Prepare data for AccountLedger
           $data = [
               "account_id" => $sale->customer_id,
               "description" => $sale->description,
               "amount" => $sale->total_amount,
               "credit" => "cr",
               "sale_id" => $sale->id
           ];
       
           // Retrieve the account associated with the customer_id
           $account = Account::where("account_owner", $sale->customer_id)->first();
       
           if (!$account) {
               throw new Exception("Account not found for customer ID: " . $sale->customer_id);
           }
       
           // Update account balance
           $balance = $account->balance + $sale->total_amount;
           $account->update(["balance" => $balance]);
       
           // Create a new AccountLedger entry
           AccountLedger::create($data);

        }
       
    //    } else {
    //        // Prepare data for AccountLedger
    //        $data = [
    //            "account_id" => $sale->customer_id,
    //            "description" => $sale->description,
    //            "amount" => $sale->total_amount,
    //            "debit" => "dr",
    //            "sale_id" => $sale->id
    //        ];
       
    //        // Create a new AccountLedger entry
    //        AccountLedger::create($data);
    //    }
       
       // dd($sale);
        //
    }
}
