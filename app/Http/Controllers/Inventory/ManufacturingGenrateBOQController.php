<?php

namespace App\Http\Controllers\Inventory;

use App\Http\Controllers\Controller;
use App\Http\Helpers\Utility;
use App\Models\Inventory\Manufacturing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ManufacturingGenrateBOQController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request, Manufacturing $manufacturing)
    {
        //
        DB::beginTransaction();
        $quantity_in_default_unit = Utility::convert($manufacturing->unit, $manufacturing->item->unit, $manufacturing->quantity);
        foreach ($manufacturing->item->materials as $material) {
            $manufacturing->materials()->create([
                "inventory_item_material_id" => $material->id,
                "quantity" => $material->quantity * $quantity_in_default_unit
            ]);
        }
        $manufacturing->status = "BOQ";
        $manufacturing->update();
        DB::commit();

        return redirect(route("inventory.manufacturings.show", ["manufacturing" => $manufacturing]));
    }
}
