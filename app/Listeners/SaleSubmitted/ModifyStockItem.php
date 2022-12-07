<?php

namespace App\Listeners\SaleSubmitted;

use App\Events\SaleSubmited;
use App\Http\Helpers\Utility;
use App\Models\Inventory\InventoryStockItem;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class ModifyStockItem
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
     * @param  \App\Events\SaleSubmited  $event
     * @return void
     */
    public function handle(SaleSubmited $event)
    {
        //
        $sale = $event->sale;
        // Deduct Stock From Stock Items and Update the in stock
        foreach ($sale->salesItems as $saleItem) {
            foreach ($saleItem->stockItems as $saleItemStockItem) {
                $stockItem = InventoryStockItem::find($saleItemStockItem->stock_item_id);
                $qty = Utility::convert($saleItem->unit, $saleItem->item->unit, $saleItemStockItem->quantity);
                $stockItem->in_stock = $stockItem->in_stock - $qty;
                $stockItem->update();

                // Record the Transactions of where those items went
                $stockItem->stockTransfered()->create([
                    "destination_id" => $saleItemStockItem->id,
                    "destination_type" => get_class($saleItemStockItem),
                    "inv_item_id" => $saleItem->inv_item_id,
                    "quantity" => $qty
                ]);

                // Modify In The Warehouse Item Instock Value by decrementing
                $warehouseItem = $stockItem->warehouse->findItem($stockItem->item);
                $stockItem->warehouse->updateItemInstock($stockItem->item, $warehouseItem->pivot->in_stock - $qty);

                // Modify the Item In Stock Value
                $stockItem->item->updateInStock();
            }
        } 
    }
}
