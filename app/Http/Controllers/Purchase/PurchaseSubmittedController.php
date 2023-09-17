<?php

namespace App\Http\Controllers\Purchase;

use App\Events\PurchaseSubmited;
use App\Http\Controllers\Controller;
use App\Models\Purchase\Purchase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PurchaseSubmittedController extends Controller
{
    public function __invoke(Request $request ,Purchase $purchase)
    {
        $data=[];
        $data["status"]="SUBMITED";
        $data["warehouse_id"]=$request->warehouse_id;
        $data["submited_at"]=date('Y-m-d H:i:s');

        DB::beginTransaction();
        $purchase->update($data);
        PurchaseSubmited::dispatch($purchase);
        DB::commit();
        
        return redirect(route("purchase.purchases.show",["purchase"=>$purchase]));
    }
    
}
