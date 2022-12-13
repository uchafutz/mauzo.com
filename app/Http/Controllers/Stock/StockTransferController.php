<?php

namespace App\Http\Controllers\Stock;

use App\Http\Controllers\Controller;
use App\Models\Inventory\InventoryWarehouse;
use App\Models\Stock\StockTransfer;
use App\Models\Stock\StockTransferItem;
use Illuminate\Http\Request;

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
        $wareHouse = new InventoryWarehouse();
        $wareHouses = $wareHouse->all();
        $wareHouseInventory = $wareHouse->items();
        //dd($wareHouseInventory);
        dd($wareHouseInventory);
        return view('resources.stock.transfers.form');
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