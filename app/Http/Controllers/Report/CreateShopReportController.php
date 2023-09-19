<?php

namespace App\Http\Controllers\Report;

use App\Http\Controllers\Controller;
use App\Models\Expense\Expense;
use App\Models\Purchase\Purchase;
use App\Models\Sale\Sale;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf as PDF;
use Illuminate\Database\Eloquent\Builder;

class CreateShopReportController extends Controller
{
        /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $request->validate([
            'from' => "required",
            'to' => "required",

        ]);

        $from = $request->input("from");
        $to = $request->input("to");
        $vendor_type = $request->input('vendor_type');
        $shop_id = $request->input('shop_id');

        // $salesTotal = Sale::with('salesItems')->where(["status" => "SUBMITED"])->whereDate('date', '>', $from)->whereDate('date', '<=', $to)->sum('total_amount');
        // $expense_type = '';

        $expenses_query = Expense::whereDate('created_at', '>=', $from)->whereDate('created_at', '<=', $to);

        if ($shop_id) {
            $expenses_query->where('inventory_warehouse_id', $shop_id);
        }

        $expenses = $expenses_query->sum('amount');


        $purchases = Purchase::with('items')->where('purchases.warehouse_id', $shop_id)->get();
        $total_purchase = 0;

        foreach ($purchases as $key => $purchase) {
            $total_purchase += intval($purchase->items[0]->unit_price) * $purchase->items[0]->quantity;
        }
        

        $sales = Sale::where('inventory_warehouse_id', $shop_id)->sum('total_amount');


        $data = ['salesTotal' => $sales, 'total_purchase' => $total_purchase, 'expenses' => $expenses, 'from' => $from, 'to' => $to, 'vendor' => $vendor_type];

        view()->share('resources.report.sales.report', $data);
        $pdf = PDF::loadView('resources.report.sales.report', $data);
        return $pdf->download('PROFIT REPORT.pdf');
    }
}
