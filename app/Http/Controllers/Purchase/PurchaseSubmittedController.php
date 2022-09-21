<?php

namespace App\Http\Controllers\Purchase;

use App\Events\PurchaseSubmited;
use App\Http\Controllers\Controller;
use App\Models\Purchase\Purchase;
use Illuminate\Http\Request;

class PurchaseSubmittedController extends Controller
{
    public function __invoke(Request $request ,Purchase $purchase)
    {
        $data=[];
        $data["status"]="SUBMITED";
        $data["warehouse_id"]=$request->warehouse_id;
        $data["submited_at"]=date('Y-m-d H:i:s');
        
        $purchase->update($data);
        PurchaseSubmited::dispatch($purchase);
        return redirect(route("purchase.purchases.show",["purchase"=>$purchase]));
    }
    
}
