<?php

namespace App\Http\Controllers\Report;

use App\Http\Controllers\Controller;
use App\Models\Inventory\InventoryItem;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf as PDF;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Builder as EloquentBuilder;
use Illuminate\Support\Facades\Auth;

class StockAvailableController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        if (Auth::user()->is_admin) {
            $inventoryItem_orders = InventoryItem::whereColumn('reorder_level', '>', 'in_stock')->get();   
        }else{
            $inventoryItem_orders = InventoryItem::with(['warehouses' => function ($query) {
                $query->where('inventory_warehouses.id', Auth::user()->inventory_warehouse_id);
            }])->whereColumn('reorder_level', '>', 'in_stock')->get();            
        }

        $data = ["inventoryItem_orders" => $inventoryItem_orders];
        view()->share('resources.report.stock.available', $data);
        $pdf = PDF::loadView('resources.report.stock.available', $data);
        return $pdf->download('STOCK REPORT.pdf');
        //
    }
}
