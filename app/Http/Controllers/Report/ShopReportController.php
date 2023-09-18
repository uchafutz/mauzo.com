<?php

namespace App\Http\Controllers\Report;

use App\Http\Controllers\Controller;
use App\Models\Inventory\InventoryWarehouse;
use Illuminate\Http\Request;

class ShopReportController extends Controller
{
      /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $shops = InventoryWarehouse::all();

        return view("resources.report.shops.index", compact("shops"));
    }
}
