<?php

namespace App\Http\Controllers\Stock;

use App\Events\StockTransferEvent;
use App\Http\Controllers\Controller;
use App\Models\Stock\StockTransfer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StockSubmitTransferController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request, StockTransfer $stockTransfer)
    {
        //DB::beginTransaction();

        StockTransferEvent::dispatch($stockTransfer);
        //  DB::commit();

        if ($request->wantsJson()) {
            return response()->json([
                "data" => $stockTransfer
            ], 200);
        }

        return redirect(route("stock.stockTransfers.show", ['stockTransfer' => $stockTransfer]));
    }
}
