<?php

namespace App\Http\Controllers\Purchase;

use App\Http\Controllers\Controller;
use App\Models\Purchase\Purchase;
use Illuminate\Http\Request;

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
        
        return view("resources.purchase.purchases.form");
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
            "code"=>["required","unique:purchases,code"],
            "date"=>["required"],
            
        ]);

        $purchase=Purchase::create($request->input());
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
        //
        dd($purchase->items);
        return view("resources.purchase.show",compact("purchase"));
        if(request()->wantsJson()){
            return response(
                [
                    "data"=>$purchase
                ],200
            );
        }
     
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
     return view("resources.purchase.purchases.form",compact("purchase"));
       
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
        $purchase->update($request->input());
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
