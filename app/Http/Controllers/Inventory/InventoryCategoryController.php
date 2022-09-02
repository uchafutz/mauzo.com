<?php

namespace App\Http\Controllers\Inventory;

use App\Http\Controllers\Controller;
use App\Models\Inventory\InventoryCategory;
use App\Models\Inventory\InventoryItem;
use Illuminate\Http\Request;


class InventoryCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $inventoryCategories=InventoryCategory::all();
        if(request()->wantsJson()){
            return response([
                "data"=>$inventoryCategories
            ],200);
        }
        return view("resources.Inventory.category.index",["inventoryCategories"=> $inventoryCategories ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {  
        $inventoryCategories=InventoryCategory::all();
        return view ("resources.Inventory.category.form",compact("inventoryCategories"));
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
            "name"=>['required','unique:inventory_categories,name'],
         
        ]);
       $inventories=InventoryCategory::create($request->input());
       if(request()->wantsJson()){
        return response([
            "data"=>$inventories
        ],201);
       }
        return redirect(route("inventory.inventoryCategories.index"));

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Inventory\InventoryCategory  $inventoryCategory
     * @return \Illuminate\Http\Response
     */
    public function show(InventoryCategory $inventoryCategory)
    {
        
        if(request()->wantsJson()){
            return response([
                "data"=>$inventoryCategory
            ],200);
        }
        return view("resources.Inventory.category.show",["inventory"=>$inventoryCategory]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Inventory\InventoryCategory  $inventoryCategory
     * @return \Illuminate\Http\Response
     */
    public function edit(InventoryCategory $inventoryCategory)
    {
        
        return view("resources.Inventory.category.form",["inventory"=>$inventoryCategory]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Inventory\InventoryCategory  $inventoryCategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, InventoryCategory $inventoryCategory)
    {
        $inventoryCategory->update($request->input());
        if(request()->wantsJson()){
            return response([
                "data"=>$inventoryCategory
            ],200);
        }
        return redirect(route("inventory.inventoryCategories.index"));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Inventory\InventoryCategory  $inventoryCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(InventoryCategory $inventoryCategory)
    {

        $inventoryCategory->delete();
        if(request()->wantsJson()){
            return response(null,204);
        }
        return redirect(route('inventory.inventoryCategories.index'));
        //
    }
}
