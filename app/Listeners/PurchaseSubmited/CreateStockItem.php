<?php

namespace App\Listeners\PurchaseSubmited;

use App\Models\Inventory\InventoryStockItem;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class CreateStockItem
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
        //
        $purchase = $event->purchase;
        
        foreach ($purchase->items as $item) {
            $item->stockItems()->save(new InventoryStockItem([
                
            ]));
        }
    }
}
