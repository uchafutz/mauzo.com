<?php

namespace App\Http\Controllers\Inventory;

use App\Http\Controllers\Controller;
use App\Models\Inventory\InventoryItem;
use App\Models\Inventory\InventoryStockItem;
use App\Models\Inventory\InventoryWarehouse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Tests\Feature\inventory\inventorytest;
use Barryvdh\DomPDF\Facade\Pdf as PDF;

class InventoryStockReportController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $inv_warehouse_id = Auth::user()->inventory_warehouse_id;
        $warehouse = null;

        if (Auth::user()->is_admin) {
            $inventoryItems = InventoryItem::with('stockItems')->whereHas('stockItems', function ($query) use ($inv_warehouse_id) {
                $query->where('in_stock', '>=', 1);
            })->get();
        }else{
            $inventoryItems = InventoryItem::with('stockItems')->whereHas('stockItems', function ($query) use ($inv_warehouse_id) {
                $query->where('inv_warehouse_id', $inv_warehouse_id)
                    ->where('in_stock', '>=', 1);
            })->get();
            $warehouse = InventoryWarehouse::find($inv_warehouse_id);
        }

        $data = ["inventoryItems" => $inventoryItems, 'warehouse' => $warehouse];
        view()->share('resources.report.stock.report', $data);
        $pdf = PDF::loadView('resources.report.stock.report', $data);
        return $pdf->download('AVAILABLE STOCK REPORT.pdf');
    }
}
