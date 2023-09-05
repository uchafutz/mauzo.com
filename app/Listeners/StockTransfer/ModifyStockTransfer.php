<?php

namespace App\Listeners\StockTransfer;

use App\Events\StockItemCreated;
use App\Events\StockTransferEvent;
use App\Http\Helpers\Utility;
use App\Models\Inventory\InventoryStockItem;
use App\Models\Inventory\InventoryWarehouse;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\DB;

class ModifyStockTransfer
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
    public function handle(StockTransferEvent $event)
    {
        $stockTransfer = $event->stockTransfer;

        foreach ($stockTransfer->items as $itemStock) {
            $fromInvStock = InventoryStockItem::where("inv_warehouse_id", "=", $stockTransfer->from_warehouse_id)->where("inv_item_id", "=", $itemStock->inv_item_id)->first();
            $fromInvStock->in_stock = $fromInvStock->in_stock - $itemStock->quantity;
            $fromInvStock->update();


            $toInvStock =  InventoryStockItem::where("inv_warehouse_id", "=", $stockTransfer->to_warehouse_id)->where("inv_item_id", "=", $itemStock->inv_item_id)->first();
            if ($toInvStock == null) {
                DB::table('warehouse_has_items')->insert([
                    'inv_warehouse_id' => $stockTransfer->to_warehouse_id,
                    'inv_item_id' => $itemStock->inv_item_id,
                    'in_stock' => $itemStock->quantity,
                ]);
                DB::table('inventory_stock_items')->insert([
                    "inv_item_id" => $itemStock->inv_item_id,
                    "inv_warehouse_id" => $stockTransfer->to_warehouse_id,
                    "unit_cost" => 0,
                    "quantity" => $itemStock->quantity,
                    "in_stock" => $itemStock->quantity,
                    "source_id" => $stockTransfer->from_warehouse_id,
                    "source_type" => "App\Models\Purchase\PurchaseItems"
                ]);
            } else {
                //dd($toInvStock);
                $toInvStock->in_stock = $toInvStock->in_stock + $itemStock->quantity;
                $toInvStock->update();
                $newWarehouseItem = $toInvStock->warehouse->findItem($toInvStock->item);
                $toInvStock->warehouse->updateItemInstock($toInvStock->item, $newWarehouseItem->pivot->in_stock + $itemStock->quantity);
                $toInvStock->item->update();
            }



            //last thing to deal with pivot

            // Modify In The Warehouse Item Instock Value by decrementing
            $warehouseItem = $fromInvStock->warehouse->findItem($fromInvStock->item);
            $fromInvStock->warehouse->updateItemInstock($fromInvStock->item, $warehouseItem->pivot->in_stock - $itemStock->quantity);

            // Modify the Item In Stock Value
            $fromInvStock->item->updateInStock();
        }
        //dd($stockTransferItem->stockTransfer->code);


    }
}
