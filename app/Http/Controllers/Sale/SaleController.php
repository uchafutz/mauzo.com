<?php

namespace App\Http\Controllers\Sale;

use App\Http\Controllers\Controller;
use App\Models\Config\Unit;
use App\Models\Customer\Customer;
use App\Models\Inventory\InventoryItem;
use App\Models\Inventory\InventoryStockItem;
use App\Models\Inventory\InventoryWarehouse;
use App\Models\Sale\Sale;
use App\Models\Sale\SaleItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SaleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $sales=Sale::all();
        if(request()->wantsJson()){
            return response([
                "data"=>$sales
            ],200);
        }
        return view("resources.sale.sales.index",compact("sales"));
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $customers=Customer::all();
        $items=InventoryItem::with("stockItems.warehouse")->get();
        $units=Unit::all();
        return view("resources.sale.sales.form",compact("customers","items","units"));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

         //dd($request->all());
         $this->validate($request,[
            "date"=>["required"],
            "items"=>["required"],
        ]);
        
        DB::beginTransaction();
        $sale = Sale::create($request->input());
        foreach ($request->input("items") as $item) {
            $sale->salesItems()->create($item);
        }
        DB::commit();
        
        if(request()->wantsJson()){
            return response(
                [
                    "data"=>$sale
                ],201
            );
        }
        return redirect(route("sale.sales.index"));
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Sale\Sale  $sale
     * @return \Illuminate\Http\Response
     */
    public function show(Sale $sale)
    {
        if(request()->wantsJson()){
            return response([
                "data"=>$sale
            ],200);
        }
        return view("resources.sale.sales.show",compact("sale"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Sale\Sale  $sale
     * @return \Illuminate\Http\Response
     */
    public function edit(Sale $sale)
    {
        $customers=Customer::all();
        $items=InventoryItem::with("stockItems.warehouse")->get();
        $units=Unit::all();
        return view("resources.sale.sales.form",compact("customers","items","units","sale"));
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Sale\Sale  $sale
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Sale $sale)
    {
        DB::beginTransaction();
        $sale->update($request->input());
        foreach ($request->input("items") as $item) {
            if ($item["id"]) {
                $saleItem = SaleItem::find($item['id']);
                $saleItem->update($item);
            } else {
                $sale->salesItems()->create($item);
            }
        }
        DB::commit();

        if(request()->wantsJson()){
            return response(
                [
                    "data"=>$sale
                ],201
            );
        }
       return redirect(route("sale.sales.index"));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Sale\Sale  $sale
     * @return \Illuminate\Http\Response
     */
    public function destroy(Sale $sale)
    {
        $sale->delete();
        if(request()->wantsJson()){
            return response(null,204 );
        }
       return redirect(route("sale.sales.index"));
        //
    }
}
