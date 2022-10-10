<?php

namespace App\Http\Controllers\Inventory;

use App\Http\Controllers\Controller;
use App\Http\Helpers\Utility;
use App\Models\Config\Unit;
use App\Models\Config\UnitType;
use App\Models\Inventory\InventoryCategory;
use App\Models\Inventory\InventoryItem;
use Illuminate\Http\Request;

class InventoryItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $inventoryItems = InventoryItem::all();
        if (request()->wantsJson()) {
            return response([
                "data" => $inventoryItems
            ], 200);
        }

        return view("resources.inventory.items.index", compact("inventoryItems"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $unitTypes = UnitType::all();
        $inventoryCategories = InventoryCategory::all();
        $units = Unit::all();
        return view("resources.inventory.items.form", compact("unitTypes", "inventoryCategories", "units"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate([
            "name" => ["required", "unique:inventory_items,name"],
            "unit_type_id" => ["required"],
            "inventory_category_id" => ["required"],
            "default_unit_id" => ["required"],

        ]);
        $inventoryItem = new InventoryItem();
        $inventoryItem->fill($request->input());
        if (request()->hasFile("featured_image")) {
            $inventoryItem->featured_image = Utility::uploadFile("featured_image");
        }
        $inventoryItem->save();
        if (request()->wantsJson()) {
            return response([
                "data" => $inventoryItem
            ], 201);
        }
        return redirect(route("inventory.inventoryItems.index"));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Inventory\InventoryItem  $inventoryItem
     * @return \Illuminate\Http\Response
     */
    public function show(InventoryItem $inventoryItem)

    {


        if (request()->wantsJson()) {
            return response([
                "data" => $inventoryItem
            ], 200);
        }
        return view("resources.inventory.items.show", compact("inventoryItem"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Inventory\InventoryItem  $inventoryItem
     * @return \Illuminate\Http\Response
     */
    public function edit(InventoryItem $inventoryItem)
    {
        $unitTypes = UnitType::all();
        $inventoryCategories = InventoryCategory::all();
        $units = Unit::all();

        return view("resources.inventory.items.form", compact("inventoryItem", "units", "inventoryCategories", "unitTypes"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Inventory\InventoryItem  $inventoryItem
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, InventoryItem $inventoryItem)
    {

        $inventoryItem->fill($request->input());
        if (request()->hasFile("featured_image")) {
            $inventoryItem->featured_image = Utility::uploadFile("featured_image");
        }
        $inventoryItem->update();

        if (request()->wantsJson()) {
            return response([
                "data" => $inventoryItem
            ], 200);
        }
        return redirect(route("inventory.inventoryItems.index"));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Inventory\InventoryItem  $inventoryItem
     * @return \Illuminate\Http\Response
     */
    public function destroy(InventoryItem $inventoryItem)
    {
        $inventoryItem->delete();
        if (request()->wantsJson()) {
            return response(null, 204);
        }
        return redirect(route("inventory.inventoryItems.index"));
    }
}