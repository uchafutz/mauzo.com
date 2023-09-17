<?php

namespace App\Http\Controllers\Inventory;

use App\Events\ManufacturingSubmited;
use App\Http\Controllers\Controller;
use App\Models\Inventory\Manufacturing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ManufacturingSubmitController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request, Manufacturing $manufacturing)
    {
        // Validate the Request
        $flag_raw_material_has_no_assignment = false;
        foreach ($manufacturing->materials as $material) {
            if ($material->type == "RAW") {
                if (!$material->stockItems->count()) {
                    $flag_raw_material_has_no_assignment = true;
                }
            }
        }

        if ($flag_raw_material_has_no_assignment) {
            return redirect()->back()->with("error", "Some of the materials have no stock assignment. Make sure all materials have been assigned proper stock items.");
        }

        DB::beginTransaction();
        $manufacturing->status = 'PROCESSED';
        $manufacturing->update();
        ManufacturingSubmited::dispatch($manufacturing);
        DB::commit();

        return redirect()->back()->with("success", "Manufacturing Batch Processed");
    }
}
