<?php

namespace App\Listeners\ManufacturingSubmitted;

use App\Events\ManufacturingSubmited;
use App\Events\StockItemCreated;
use App\Http\Helpers\Utility;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class GenerateItems
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
        $convertedQuantity = Utility::convert($manufacturing->unit, $manufacturing->item->unit, $manufacturing->quantity);
        // $convertedUnitCost = ($item->unit_price * $item->quantity)/$convertedQuantity;

        $totalCost = $manufacturing->materials->reduce(function($carry, $material) {
            $total = 0;
            foreach ($material->stockItems as $stockItem) {
                $total +=  $stockItem->pivot->quantity * $stockItem->unit_cost;
            }
            return $carry + $total;
        }, 0);

        

        $unitCost = $totalCost/$convertedQuantity;

        $stockItem = $manufacturing->stockItems()->create([
            "inv_item_id" => $manufacturing->inventory_item_id,
            "inv_warehouse_id" => $manufacturing->warehouse_id,
            "unit_cost" => $unitCost,
            "quantity" => $convertedQuantity,
            "in_stock" => $convertedQuantity,
        ]);
        StockItemCreated::dispatch($stockItem);
    }
}
