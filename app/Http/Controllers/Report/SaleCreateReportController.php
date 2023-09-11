<?php

namespace App\Http\Controllers\Report;

use App\Http\Controllers\Controller;
use App\Models\Expense\Expense;
use App\Models\Purchase\Purchase;
use App\Models\Sale\Sale;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf as PDF;

class SaleCreateReportController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $total_purchase = 0;
        $request->validate([
            'from' => "required",
            'to' => "required",

        ]);

        $from = $request->input("from");
        $to = $request->input("to");
        $salesTotal = Sale::with('salesItems')->where(["status" => "SUBMITED"])->whereDate('date', '>', $from)->whereDate('date', '<=', $to)->sum('total_amount');
        $expensess = Expense::whereDate('created_at', '>', $from)->whereDate('created_at', '<=', $to)->sum('amount');
        $purchases = Purchase::with('items', 'warehouses')->where(["status" => "SUBMITED"])->whereDate('date', '>', $from)->whereDate('date', '<=', $to)->get();
        foreach ($purchases as $purchase) {
            foreach ($purchase->items as $purchaseItem) {
                $total = 0;
                $amount = $purchaseItem->unit_price * $purchaseItem->quantity;
                $total += $amount;
                $total_purchase += $total;
            }
        }

        // share data to view
        $data =  ['total_purchase' => $total_purchase, 'from' => $from, 'to' => $to, 'salesTotal' => $salesTotal, 'expensess' => $expensess];

        view()->share('resources.report.sales.report', $data);
        $pdf = PDF::loadView('resources.report.sales.report', $data);
        // download PDF file with download method
        return $pdf->download('PROFIT REPORT.pdf');
        // dd($data);
    }
}
