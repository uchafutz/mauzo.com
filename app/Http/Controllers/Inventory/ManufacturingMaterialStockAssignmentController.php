<?php

namespace App\Http\Controllers\Inventory;

use App\Http\Controllers\Controller;
use App\Models\Inventory\Manufacturing;
use App\Models\Inventory\ManufacturingMaterial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ManufacturingMaterialStockAssignmentController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request, Manufacturing $manufacturing, ManufacturingMaterial $manufacturingMaterial)
    {
        $request->validate([
            "items.*.stock_item_id" => ["required"],
            "items.*.quantity" => ["required"],
            // "items.*.stock_item_snapshot" => ["required"],
        ]);

        DB::beginTransaction();
        $payload = [];
        foreach ($request->input("items") as $item) {
            $payload[$item['stock_item_id']] = ['quantity' => $item['quantity']];
        }
        $manufacturingMaterial->stockItems()->sync($payload);
        DB::commit();

        return redirect(route("inventory.manufacturings.show", ["manufacturing" => $manufacturing]));
    }
}
