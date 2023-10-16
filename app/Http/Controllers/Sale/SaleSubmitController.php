<?php

namespace App\Http\Controllers\Sale;

use App\Events\SaleSubmited;
use App\Http\Controllers\Controller;
use App\Models\Sale\Sale;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SaleSubmitController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request, Sale $sale)
    {
        //
        DB::beginTransaction();
        $sale->status = "SUBMITED";
        $sale->update();
        SaleSubmited::dispatch($sale);
        DB::commit();

        if ($request->wantsJson()) {
            return response()->json([
                "data" => $sale
            ], 200);
        }

        return redirect(route("sale.sales.show", ['sale' => $sale]));
    }
}
