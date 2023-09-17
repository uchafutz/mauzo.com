<?php

namespace App\Http\Controllers;

use App\Models\Inventory\InventoryItem;
use App\Models\Inventory\InventoryStockItem;
use App\Models\Purchase\Purchase;
use App\Models\Sale\Sale;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    //
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if (auth()->user()->is_admin) {
            //sales
            $saleTotal = Sale::where('status', 'SUBMITED')->sum('total_amount');
            $saleOrder = Sale::where('status', '=', 'SUBMITED')->count();

            //purchases
            $purchaseTotal = Purchase::join('purchase_items', 'purchase_items.purchase_id', '=', 'purchases.id')->where('purchases.status', '=', 'SUBMITED')->groupBy('purchases.id')->get(['purchases.id', DB::raw('sum(purchase_items.quantity*purchase_items.unit_price) as value')])->sum('value');
            $purchaseOrder = Purchase::join('purchase_items', 'purchase_items.purchase_id', '=', 'purchases.id')->where('purchases.status', '=', 'SUBMITED')->count();


            //Inventory Items
            // $inventoryTotal = InventoryItem::count();
            $inventoryTotal = InventoryStockItem::sum('in_stock');

            $inventoryProduct = InventoryItem::where('is_product', 1)->count();
        
        }else{
            //sales
            $saleTotal = Sale::where('status', 'SUBMITED')->where('user_id',auth()->user()->id)->sum('total_amount');
            $saleOrder = Sale::where('status', '=', 'SUBMITED')->where('user_id',auth()->user()->id)->count();


            //purchases
            $purchaseTotal = Purchase::join('purchase_items', 'purchase_items.purchase_id', '=', 'purchases.id')->where('purchases.status', '=', 'SUBMITED')->where('user_id',auth()->user()->id)->groupBy('purchases.id')->get(['purchases.id', DB::raw('sum(purchase_items.quantity*purchase_items.unit_price) as value')])->sum('value');
            $purchaseOrder = Purchase::join('purchase_items', 'purchase_items.purchase_id', '=', 'purchases.id')->where('purchases.status', '=', 'SUBMITED')->where('user_id',auth()->user()->id)->count();


            //Inventory Items
            // $inventoryTotal = InventoryItem::count();
            $inventoryTotal = InventoryStockItem::where('inv_warehouse_id', auth()->user()->inventory_warehouse_id)->sum('in_stock');

            $inventoryProduct = InventoryItem::where('is_product', 1)->count();

            return redirect(route('sale.sales.index'));
            
        }



        //Inventory Items
        $itemsTops = InventoryItem::join('sale_items', 'sale_items.inv_item_id', 'inventory_items.id')->select(DB::raw('DISTINCT(sale_items.inv_item_id)'), 'name',)->groupBy('sale_items.inv_item_id', 'inventory_items.name')->get();

        // $itemsTops = [];
        // dd($itemsTops);

        return view('home', compact('saleTotal', 'saleOrder', 'purchaseTotal', 'purchaseOrder', 'inventoryTotal', 'inventoryProduct', 'itemsTops'));
    }
}