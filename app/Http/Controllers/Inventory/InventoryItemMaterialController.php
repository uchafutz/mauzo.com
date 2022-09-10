<?php

namespace App\Http\Controllers\Inventory;

use App\Http\Controllers\Controller;
use App\Models\Inventory\InventoryItem;
use App\Models\Inventory\InventoryItemMaterial;
use Illuminate\Http\Request;

class InventoryItemMaterialController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \App\Models\Inventory\InventoryItem  $inventoryItem
     * @return \Illuminate\Http\Response
     */
    public function index(InventoryItem $inventoryItem)
    {
        $inventoryItemMaterials=InventoryItemMaterial::all();
        if(request()->wantsJson()){
            return response([
                "data" =>[$inventoryItem,$inventoryItemMaterials]
            ],200);
        }
    

    }

    /**
     * Show the form for creating a new resource.
     *
     * @param  \App\Models\Inventory\InventoryItem  $inventoryItem
     * @return \Illuminate\Http\Response
     */
    public function create(InventoryItem $inventoryItem)
    {
        $inventoryItems=InventoryItem::where("is_material", true)->get();
        return view("resources.inventory.items.materials.form",compact("inventoryItem","inventoryItems"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Inventory\InventoryItem  $inventoryItem
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, InventoryItem $inventoryItem)
    {
    
      $request->validate([
        "quantity"=>["required","numeric"],
        "source_inv_items_id"=>["required"],
        "material_inv_items_id"=>["required"],
        "type"=>["required"]
      ]);
      $inventoryItemMaterial=InventoryItemMaterial::create($request->input());
      if(request()->wantsJson()){
        return response([
            "data"=>$inventoryItemMaterial
        ],201);
      }
      return redirect(route("inventory.inventoryItems.show",compact("inventoryItem")));


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Inventory\InventoryItem  $inventoryItem
     * @param  \App\Models\Inventory\InventoryItemMaterial  $inventoryItemMaterial
     * @return \Illuminate\Http\Response
     */
    public function show(InventoryItem $inventoryItem, InventoryItemMaterial $inventoryItemMaterial)
    {
        if(request()->wantsJson()){
            return response([
                "data"=>[$inventoryItem,$inventoryItemMaterial]
            ],200);
        }
    
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Inventory\InventoryItem  $inventoryItem
     * @param  \App\Models\Inventory\InventoryItemMaterial  $inventoryItemMaterial
     * @return \Illuminate\Http\Response
     */
    public function edit(InventoryItem $inventoryItem, InventoryItemMaterial $inventoryItemMaterial)
    {
        $inventoryItems=InventoryItem::where("is_material", true)->get();
        return view("resources.inventory.items.materials.form",compact("inventoryItem","inventoryItems", "inventoryItemMaterial"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Inventory\InventoryItem  $inventoryItem
     * @param  \App\Models\Inventory\InventoryItemMaterial  $inventoryItemMaterial
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, InventoryItem $inventoryItem, InventoryItemMaterial $inventoryItemMaterial)
    {
        $inventoryItemMaterial->update($request->input());
        if(request()->wantsJson()){
          return response([
              "data"=>$inventoryItemMaterial
          ],201);
        }
        return redirect(route("inventory.inventoryItems.show",compact("inventoryItem")));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Inventory\InventoryItem  $inventoryItem
     * @param  \App\Models\Inventory\InventoryItemMaterial  $inventoryItemMaterial
     * @return \Illuminate\Http\Response
     */
    public function destroy(InventoryItem $inventoryItem, InventoryItemMaterial $inventoryItemMaterial)
    {
        $inventoryItemMaterial->delete();
        if(request()->wantsJson()){
            return response(null,204);
        }
        return redirect(route("inventory.inventoryItems.show",compact("inventoryItem")));
    }
}
