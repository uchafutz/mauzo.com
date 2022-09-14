<?php

namespace App\Http\Controllers\Purchase;

use App\Http\Controllers\Controller;
use App\Models\Config\Unit;
use App\Models\Inventory\InventoryItem;
use App\Models\Purchase\Purchase;
use App\Models\Purchase\PurchaseItems;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PurchaseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
     
        $purchases=Purchase::all();
        if(request()->wantsJson()){
            return response([
                "data"=>$purchases
            ],200);
        }

        return view("resources.purchase.purchases.index",compact("purchases"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        $items=InventoryItem::all();
        $units=Unit::all();
        return view("resources.purchase.purchases.form",compact("units","items"));
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
            "code"=>["required","unique:purchases,code"],
            "date"=>["required"],
            "inv_items_id"=>["required"],
            "conf_units_id"=>["required"],
            "quantity.*"=>["required","numeric"],
            "amount.*"=>["required","numeric"]
        ]);
        
        $data = [];
        $data["code"] = $request->code;
        $data["description"] = $request->description;
        $data["date"]=$request->date;
        DB::beginTransaction();
        $purchase = Purchase::create($data);
        if($purchase->wasRecentlyCreated){
         $purchases_id=$purchase->id;
         $items =[];
         if(is_array($request->inv_items_id)){
            $i =0;
            foreach($request->inv_items_id as $item){
                $items[] = new PurchaseItems([
                    'inv_items_id' => $item,
                    'quantity' => $request->quantity[$i],
                    'amount' => $request->amount[$i],
                    'conf_units_id' => $request->conf_units_id[$i],
                    'conf_unit_types_id' => Unit::where('id',$request->conf_units_id[$i])->first()->unit_type_id ?? 0,
                    // 'purchases_id' => $purchase->id,
                ]);
                $i++;
            }
         }
         
        }
        $purchase->items()->saveMany($items);
        //dd($items);
        DB::commit();
      
        
        if(request()->wantsJson()){
            return response(
                [
                    "data"=>$purchase
                ],201
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
    

       $purchaseItems= $purchase->items;
       if(request()->wantsJson()){
        return response(
            [
                "data"=>[$purchaseItems]
            ],200
        );
    }
        return view("resources.purchase.purchases.show",compact("purchaseItems"));
        
     
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Purchase\Purchase  $purchase
     * @return \Illuminate\Http\Response
     */
    public function edit(Purchase $purchase)
    {
    $items=InventoryItem::all();
    $units=Unit::all();
    $purchaseItems= $purchase->items;
     return view("resources.purchase.purchases.form",compact("purchase","items","units","purchaseItems"));
       
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
       // dd($request->input());
        //dd($request->all());
        // $debug = [
        //     "inventory items id lenght" => count($request->inv_items_id),
        //     "invevntory items" => $request->inv_items_id,
        //     "purchase items length" => count($request->purchaseItem_id),
        //     "purchase items" => $request->purchaseItem_id,
        // ];
       // dd($debug);
        $purchase->update($request->input());
        $items =[];
        if(is_array($request->inv_items_id)){
           $i =0;
           foreach($request->inv_items_id as $item){
               PurchaseItems::where('id',$request->purchaseItem_id)->update([
                   'inv_items_id' => $item,
                   'quantity' => $request->quantity[$i],
                   'amount' => $request->amount[$i],
                   'conf_units_id' => $request->conf_units_id[$i],
                   'conf_unit_types_id' => Unit::where('id',$request->conf_units_id[$i])->first()->unit_type_id ?? 0,
                 'purchases_id' => $request->purchases_id
               ]);
               $i++;
           }
        }
         if(request()->wantsJson()){
            return response(
                [
                    "data"=>$purchase
                ],201
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
        if(request()->wantsJson()){
            return response(null,204);
        }
     return redirect(route("purchase.purchases.index"));
    }
}
