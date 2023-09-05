<?php

namespace App\Http\Controllers\Inventory;

use App\Http\Controllers\Controller;
use App\Http\Helpers\Utility;
use App\Models\Inventory\InventoryWarehouse;
use Illuminate\Http\Request;

class InventoryWarehouseController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(InventoryWarehouse::class, 'invetoryWarehouse');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $inventoryWarehouses = InventoryWarehouse::all();

        if (request()->wantsJson()) {
            return response([
                "data" => $inventoryWarehouses,
            ], 200);
        }
        return view("resources.inventory.warehouses.index", compact("inventoryWarehouses"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view("resources.inventory.warehouses.form");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            "name" => ["required", "unique:inventory_warehouses,name"],
        ]);

        $inventoryWarehouse = new InventoryWarehouse();
        $inventoryWarehouse->fill($request->input());

        if ($request->hasFile("featured_image")) {
            $inventoryWarehouse->featured_image = Utility::uploadFile("featured_image");
        }

        $inventoryWarehouse->save();

        if ($request->wantsJson()) {
            return response([
                "data" => $inventoryWarehouse,
            ], 201);
        }

        return redirect(route("inventory.inventoryWarehouses.index"));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Inventory\InventoryWarehouse  $inventoryWarehouse
     * @return \Illuminate\Http\Response
     */
    public function show(InventoryWarehouse $inventoryWarehouse)
    {
        //
        if (request()->wantsJson()) {
            return response([
                "data" => $inventoryWarehouse,
            ], 200);
        }
        return view("resources.inventory.inventoryWarehouses.show", compact("inventoryWarehouse"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Inventory\InventoryWarehouse  $inventoryWarehouse
     * @return \Illuminate\Http\Response
     */
    public function edit(InventoryWarehouse $inventoryWarehouse)
    {
        //
        return view("resources.inventory.warehouses.form", compact("inventoryWarehouse"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Inventory\InventoryWarehouse  $inventoryWarehouse
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, InventoryWarehouse $inventoryWarehouse)
    {
        //
        $inventoryWarehouse->fill($request->input());

        if ($request->hasFile("featured_image")) {
            $inventoryWarehouse->featured_image = Utility::uploadFile("featured_image");
        }

        $inventoryWarehouse->update();

        if ($request->wantsJson()) {
            return response([
                "data" => $inventoryWarehouse,
            ], 200);
        }

        return redirect(route("inventory.inventoryWarehouses.index"));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Inventory\InventoryWarehouse  $inventoryWarehouse
     * @return \Illuminate\Http\Response
     */
    public function destroy(InventoryWarehouse $inventoryWarehouse)
    {
        //
        $inventoryWarehouse->delete();
        
        if (request()->wantsJson()) {
            return response(null, 204);
        }

        return redirect(route("inventory.inventoryWarehouses.index"));
    }
}
