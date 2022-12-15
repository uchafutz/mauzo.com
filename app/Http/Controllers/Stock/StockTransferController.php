<?php

namespace App\Http\Controllers\Stock;

use App\Http\Controllers\Controller;
use App\Models\Config\Unit;
use App\Models\Inventory\InventoryItem;
use App\Models\Inventory\InventoryWarehouse;
use App\Models\Stock\StockTransfer;
use App\Models\Stock\StockTransferItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StockTransferController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \App\Models\Stock\StockTransfer  $stockTransfer
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $stockTransfers = StockTransfer::all();
        if (request()->wantsJson()) {
            return response()->json($stockTransfers);
        }

        return view('resources.stock.transfers.index', compact('stockTransfers'));
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param  \App\Models\Stock\StockTransfer  $stockTransfer
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $inventoryWarehouse = new InventoryWarehouse();
        $wareHouses = $inventoryWarehouse->with(['items.unit', 'items.stockItems'])->get();
        $units = Unit::all();

        return view('resources.stock.transfers.form', compact('wareHouses', 'units'));
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Stock\StockTransfer  $stockTransfer
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, StockTransfer $stockTransfer)
    {


        dd($request->all());
        $request->validate([
            "from_warehouse_id" => ["required"],
            "to_warehouse_id" => ["required"],
            "date" => ["required"],
            "items" => ["required"],


        ]);
        DB::beginTransaction();
        $stockTransfer = StockTransfer::create($request->input());
        foreach ($request->input("items") as $item) {
            $stockTransfer->items()->create($item);
        }
        DB::commit();

        if (request()->wantsJson()) {
            return response(
                [
                    "data" => $stockTransfer
                ],
                201
            );
        }
        return $this->index();


        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Stock\StockTransfer  $stockTransfer
     * @param  \App\Models\Stock\StockTransferItem  $stockTransferItem
     * @return \Illuminate\Http\Response
     */
    public function show(StockTransfer $stockTransfer, StockTransferItem $stockTransferItem)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Stock\StockTransfer  $stockTransfer
     * @param  \App\Models\Stock\StockTransferItem  $stockTransferItem
     * @return \Illuminate\Http\Response
     */
    public function edit(StockTransfer $stockTransfer, StockTransferItem $stockTransferItem)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Stock\StockTransfer  $stockTransfer
     * @param  \App\Models\Stock\StockTransferItem  $stockTransferItem
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, StockTransfer $stockTransfer, StockTransferItem $stockTransferItem)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Stock\StockTransfer  $stockTransfer
     * @param  \App\Models\Stock\StockTransferItem  $stockTransferItem
     * @return \Illuminate\Http\Response
     */
    public function destroy(StockTransfer $stockTransfer, StockTransferItem $stockTransferItem)
    {
        //
    }
}