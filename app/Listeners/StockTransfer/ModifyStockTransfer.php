<?php

namespace App\Listeners\StockTransfer;

use App\Events\StockItemCreated;
use App\Events\StockTransferEvent;
use App\Http\Helpers\Utility;
use App\Models\Inventory\InventoryItem;
use App\Models\Inventory\InventoryStockItem;
use App\Models\Inventory\InventoryWarehouse;
use App\Models\Stock\StockTransfer;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;


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
        //   $stockTransferAction = new StockTransfer();

        $stockTransfer = $event->stockTransfer;
        $stockTransfer->status = "SUBMITED";
        try {
            DB::beginTransaction();
            DB::enableQueryLog();
            foreach ($stockTransfer->items as $itemStock) {


                $fromInvStock = InventoryStockItem::where([
                    "inv_warehouse_id" => $stockTransfer->from_warehouse_id,
                    "inv_item_id" => $itemStock->inv_item_id,
                ])->where(
                    "in_stock",
                    ">=",
                    $itemStock->quantity,

                )->first();
                // dd($fromInvStock);
                $fromInvStock->in_stock = $fromInvStock->in_stock - $itemStock->quantity;
                $fromInvStock->update();
                // dd($fromInvStock);

                $stockItem = $itemStock->stockItems()->create([
                    "inv_item_id" => $itemStock->inv_item_id,
                    "inv_warehouse_id" => $stockTransfer->to_warehouse_id,
                    "unit_cost" => 0,
                    "quantity" => $itemStock->quantity,
                    "in_stock" => $itemStock->quantity,
                    "batch" => $itemStock->batch
                ]);
                StockItemCreated::dispatch($stockItem);
                $warehouseItem = $fromInvStock->warehouse->findItem($fromInvStock->item);
                $fromInvStock->warehouse->updateItemInstock($fromInvStock->item, $warehouseItem->pivot->in_stock - $itemStock->quantity);
                $fromInvStock->item->updateInStock();

                DB::commit();
            }

            $stockTransfer->update();
        } catch (\Exception $e) {
            DB::rollback();
            Log::debug($e);
            print($e);
            return response()->json(['error' => $e->getMessage()], 500);
        }

        //dd($stockTransferItem->stockTransfer->code);


    }




    private function toInventory()
    {
    }
}
