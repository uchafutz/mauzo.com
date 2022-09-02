<?php

namespace App\Http\Controllers\Inventory;

use App\Http\Controllers\Controller;
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
        $inventoryItems=InventoryItem::all();
        if(request()->wantsJson()){
            return response([
                "data"=>$inventoryItems
            ],200);
        }

        return view("resources.Inventory.item.index");
       
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("resources.Inventory.item.form");
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
            "name"=>["required","unique:inventory_items,name"],   
        ]);
      $inventoryItem=InventoryItem::create($request->input());
      if(request()->wantsJson()){
        return response([
            "data"=>$inventoryItem
        ],201);
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
        if(request()->wantsJson()){
            return response([
                "data"=>$inventoryItem
            ],200);
        }
        return view("resources.Inventory.item.show",compact("inventoryItem"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Inventory\InventoryItem  $inventoryItem
     * @return \Illuminate\Http\Response
     */
    public function edit(InventoryItem $inventoryItem)
    {
        
        return view("resources.Inventory.item.form",compact("inventoryItem"));
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
     $inventoryItem->update($request->input());
      if(request()->wantsJson()){
        return response([
            "data"=>$inventoryItem
        ],201);
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
        if(request()->wantsJson()){
            return response(null,204);
        }
        return redirect(route("inventory.inventoryItems.index"));
    }
}
