<?php

namespace App\Http\Controllers\Report;

use App\Http\Controllers\Controller;
use App\Models\Expense\Expense;
use App\Models\Sale\Sale;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf as PDF;


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

        $salesQuery = Sale::select(
            'sales.code',
            'sales.total_amount',
            'vendors.name',
            'sales.created_at',
            'users.name as salesman',
            DB::raw('SUM(purchase_items.quantity) as total_quantity'),
            DB::raw('SUM(purchase_items.unit_price) as total_unit_price')
        )
            ->join('users', 'users.id', '=', 'sales.user_id')
            ->join('sale_items', 'sales.id', '=', 'sale_items.sale_id')
            ->join('inventory_items', 'sale_items.inv_item_id', '=', 'inventory_items.id')
            ->join('purchase_items', 'inventory_items.id', '=', 'purchase_items.inv_item_id')
            ->join('purchases', 'purchase_items.purchase_id', '=', 'purchases.id')
            ->join('vendors', 'purchases.vendor_id', '=', 'vendors.id')
            ->whereDate('sales.date', '>=', $from)
            ->whereDate('sales.date', '<=', $to);

        if ($shop_id) {
            $salesQuery->where('purchases.warehouse_id', $shop_id);
        }

        $sales = $salesQuery->groupBy(
            'sales.code',
            'sales.total_amount',
            'vendors.name',
            'sales.created_at',
            'users.name'
        )
            ->get();


        $total_purchase = 0;
        $salesTotal = 0;

        foreach ($sales as $key => $sale) {
            $total_purchase += $sale->total_unit_price * $sale->total_quantity;
            $salesTotal += $sale->total_amount;
        }

        // $vendor = $vendor_id ? Vendor::find($vendor_id)->name : '';
        $data = ['salesTotal' => $salesTotal, 'total_purchase' => $total_purchase, 'expenses' => $expenses, 'from' => $from, 'to' => $to, 'vendor' => $vendor_type];

        view()->share('resources.report.sales.report', $data);
        $pdf = PDF::loadView('resources.report.sales.report', $data);
        return $pdf->download('PROFIT REPORT.pdf');
    }
}
