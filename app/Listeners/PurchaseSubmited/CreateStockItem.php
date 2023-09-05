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
            $convertedQuantity = Utility::convert($item->unit, $item->inventoryItem->unit, $item->quantity);
            $convertedUnitCost = ($item->unit_price * $item->quantity) / $convertedQuantity;
            $stockItem = $item->stockItems()->create([
                "inv_item_id" => $item->inv_item_id,
                "inv_warehouse_id" => $purchase->warehouse_id,
                "unit_cost" => $convertedUnitCost,
                "quantity" => $convertedQuantity,
                "in_stock" => $convertedQuantity,
            ]);
            StockItemCreated::dispatch($stockItem);
        }
    }
}
