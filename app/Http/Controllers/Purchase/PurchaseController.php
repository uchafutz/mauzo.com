<?php

namespace App\Http\Controllers\Purchase;

use App\Http\Controllers\Controller;
use App\Models\Config\Unit;
use App\Models\Inventory\InventoryItem;
use App\Models\Inventory\InventoryWarehouse;
use App\Models\Purchase\Purchase;
use App\Models\Purchase\PurchaseItems;
use App\Models\Vendor\Vendor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PurchaseController extends Controller
{
    public function __construct()
    {
        // $this->authorizeResource(Purchase::class, 'purchase');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        if (auth()->user()->is_admin) {
            $purchases = Purchase::all();
        }
        else{
            $purchases = Purchase::where('user_id', auth()->user()->id)->get();
        }

        if (request()->wantsJson()) {
            return response([
                "data" => $purchases
            ], 200);
        }

        return view("resources.purchase.purchases.index", compact("purchases"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $items = InventoryItem::all();
        $units = Unit::all();
        if (auth()->user()->is_admin) {
            $vendors = Vendor::all();
        }else{
            $vendors = Vendor::where('type', 'Local Vendor')->get();
        }
        return view("resources.purchase.purchases.form", compact("units", "items", "vendors"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->input('items')[0]);
        $this->validate($request, [
            "date" => ["required"],
            "items" => ["required"],
        ]);

        DB::beginTransaction();
        $purchase = Purchase::create($request->input());
        foreach ($request->input("items") as $item) {
            $purchase->items()->create($item);
        }
        DB::commit();

        if (request()->wantsJson()) {
            return response(
                [
                    "data" => $purchase
                ],
                201
            );
        }
        return redirect(route("purchase.purchases.index"));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Purchase\Purchase  $purchase
     * @return \Illuminate\Http\Response
     */
    public function show(Purchase $purchase)
    {
        if (auth()->user()->is_admin) {
            $InventoryWarehouses = InventoryWarehouse::all();
        }else{
            $InventoryWarehouses = InventoryWarehouse::where('id', auth()->user()->inventory_warehouse_id)->get();        
        }

        if (request()->wantsJson()) {
            return response(
                [
                    "data" => $purchase,
                ],
                200
            );
        }
        return view("resources.purchase.purchases.show", compact("purchase", "InventoryWarehouses"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Purchase\Purchase  $purchase
     * @return \Illuminate\Http\Response
     */
    public function edit(Purchase $purchase)
    {
        //
        $items = InventoryItem::all();
        $units = Unit::all();
        return view("resources.purchase.purchases.form", compact("purchase", "items", "units"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Purchase\Purchase  $purchase
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Purchase $purchase)
    {
        DB::beginTransaction();
        $purchase->update($request->input());
        foreach ($request->input("items") as $item) {
            if ($item["id"]) {
                $purchaseItem = PurchaseItems::find($item['id']);
                $purchaseItem->update($item);
            } else {
                $purchase->items()->create($item);
            }
        }
        DB::commit();

        if (request()->wantsJson()) {
            return response(
                [
                    "data" => $purchase
                ],
                201
            );
        }
        return redirect(route("purchase.purchases.index"));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Purchase\Purchase  $purchase
     * @return \Illuminate\Http\Response
     */
    public function destroy(Purchase $purchase)
    {
        $purchase->delete();
        if (request()->wantsJson()) {
            return response(null, 204);
        }
        return redirect(route("purchase.purchases.index"));
    }
}
