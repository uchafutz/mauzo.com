<?php

namespace App\Listeners\ManufacturingSubmitted;

use App\Events\ManufacturingSubmited;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class ConsumeMaterial
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
     * @param  \App\Events\ManufacturingSubmited  $event
     * @return void
     */
    public function handle(ManufacturingSubmited $event)
    {
        //
        $manufacturing = $event->manufacturing;

        foreach ($manufacturing->materials as $material) {
            if ($material->material->type == 'RAW') {
                foreach ($material->stockItems as $stockItem) {
                    $qty = $stockItem->pivot->quantity;
                    $stockItem->in_stock = $stockItem->in_stock - $qty;
                    $stockItem->update();

                    // Record the Transactions of where those items went
                    $stockItem->stockTransfered()->create([
                        "destination_id" => $material->id,
                        "destination_type" => get_class($material),
                        "inv_item_id" => $material->material->materialItem->id,
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
}
