<?php

namespace App\Listeners\PurchaseSubmited;

use App\Events\StockItemCreated;
use App\Http\Helpers\Utility;
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
            // per each purchase item, do unit conversion: from unints used during purchase to item default unit
            // calculate the resulting quantity
            $stockItem = $item->stockItems()->create([
                "inv_item_id" => $item->inv_item_id,
                "warehouse_id" => $purchase->warehouse_id,
                "unit_cost" => $item->unit_price,
                "quantity" => Utility::convert($item->unit, $item->item->unit, $item->quantity),
                "in_stock" => Utility::convert($item->unit, $item->item->unit, $item->quantity),
            ]);
            StockItemCreated::dispatch($stockItem);
        }
    }
}
