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
use Illuminate\Support\Facades\DB;

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
        $inv_warehouse_id = $request->warehouse_id;
        $warehouse = InventoryWarehouse::find($inv_warehouse_id);


        // $inventoryItems = InventoryWarehouse::with(['items' => function ($query) {
        //     $query->select('inventory_items.id', 'name', 'inventory_items.in_stock', 'reorder_level', 'default_unit_id')->with('unit:id,code');
        // }])->select('id')->where('id', $inv_warehouse_id)->paginate(10);

        $inventoryItems = InventoryItem::whereHas('warehouses', function ($query) use ($inv_warehouse_id) {
            $query->where('inv_warehouse_id', $inv_warehouse_id);
        })->with(['warehouses' => function ($query) use ($inv_warehouse_id) {
            $query->where('inv_warehouse_id', $inv_warehouse_id);
        }])->get();


        return view("resources.report.stock.index", ["stockItems" => $inventoryItems]);
        // $data = ["inventoryItems" => $inventoryItems, 'warehouse' => $warehouse];

        // view()->share('resources.report.stock.report', $data);
        // $pdf = PDF::loadView('resources.report.stock.report', $data);
        // return $pdf->download('AVAILABLE STOCK REPORT.pdf');
    }
}
