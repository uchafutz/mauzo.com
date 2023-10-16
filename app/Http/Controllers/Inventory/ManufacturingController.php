<?php

namespace App\Http\Controllers\Inventory;

use App\Http\Controllers\Controller;
use App\Models\Config\Unit;
use App\Models\Inventory\InventoryItem;
use App\Models\Inventory\InventoryWarehouse;
use App\Models\Inventory\Manufacturing;
use Illuminate\Http\Request;

class ManufacturingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $manufacturings = Manufacturing::all();
        
        if (request()->wantsJson()) {
            return response([
                "data" => $manufacturings,
            ], 200);
        }

        return view("resources.inventory.manufacturings.index", compact("manufacturings"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $inventoryItems = InventoryItem::where("is_manufactured", true)->get();
        $units = Unit::all();
        $warehouses = InventoryWarehouse::all();
        return view("resources.inventory.manufacturings.form", compact("inventoryItems", "units", "warehouses"));
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
            "inventory_item_id" => ["required"],
            "config_unit_id" => ["required"],
            "quantity" => ["required", "numeric"]
        ]);

        $manufacturing = Manufacturing::create($request->input());

        if ($request->wantsJson()) {
            return response([
                "data" => $manufacturing,
            ], 201);
        }

        return redirect(route("inventory.manufacturings.index"));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Inventory\Manufacturing  $manufacturing
     * @return \Illuminate\Http\Response
     */
    public function show(Manufacturing $manufacturing)
    {
        //
        if (request()->wantsJson()) {
            return response([
                "data" => $manufacturing
            ], 200);
        }

        return view("resources.inventory.manufacturings.show", compact("manufacturing"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Inventory\Manufacturing  $manufacturing
     * @return \Illuminate\Http\Response
     */
    public function edit(Manufacturing $manufacturing)
    {
        $inventoryItems = InventoryItem::where("is_manufactured", true)->get();
        $units = Unit::all();
        $warehouses = InventoryWarehouse::all();
        return view("resources.inventory.manufacturings.form", compact("inventoryItems", "units", "manufacturing", "warehouses"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Inventory\Manufacturing  $manufacturing
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Manufacturing $manufacturing)
    {
        //
        $manufacturing->update($request->input());

        if ($request->wantsJson()) {
            return response([
                "data" => $manufacturing,
            ], 200);
        }

        return redirect(route("inventory.manufacturings.index"));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Inventory\Manufacturing  $manufacturing
     * @return \Illuminate\Http\Response
     */
    public function destroy(Manufacturing $manufacturing)
    {
        //
        $manufacturing->delete();

        if (request()->wantsJson()) {
            return response(null, 204);
        }

        return redirect(route("inventory.manufacturings.index"));
    }
}
