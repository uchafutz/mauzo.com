<?php

namespace App\Listeners\StockItemCreated;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class CreateStockTransaction
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
        $stockItem = $event->stockItem;

        // perform stock transaction
        $stockItem->stockReceived()->create([
            "source_id" => $stockItem->source->id,
            "source_type" => get_class($stockItem->source),
            "inv_item_id" => $stockItem->inv_item_id,
            "quantity" => $stockItem->quantity
        ]);

        // update warehouse stock item in_stock
        $warehouseItem = $stockItem->warehouse->findItem($stockItem->item);
        $in_stock = $warehouseItem ? $warehouseItem->pivot->in_stock + $stockItem->quantity : $stockItem->quantity;
        $stockItem->warehouse->updateItemInstock($stockItem->item, $in_stock);

        // update inventory item instock
        $stockItem->item->updateInStock();
    }
}