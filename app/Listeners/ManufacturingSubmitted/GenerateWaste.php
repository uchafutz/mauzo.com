<?php

namespace App\Listeners\ManufacturingSubmitted;

use App\Events\ManufacturingSubmited;
use App\Events\StockItemCreated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class GenerateWaste
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
            if ($material->material->type == 'WASTAGE') {
                $stockItem = $material->stockItemsMorph()->create([
                    "inv_item_id" => $material->material->materialItem->id,
                    "inv_warehouse_id" => $manufacturing->warehouse_id,
                    "unit_cost" => 0,
                    "quantity" => $material->quantity,
                    "in_stock" => $material->quantity,
                ]);
                StockItemCreated::dispatch($stockItem);
            }
        }
    }
}
