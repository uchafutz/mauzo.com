<?php

namespace App\Http\Controllers\Report;

use App\Http\Controllers\Controller;
use App\Models\Customer\Customer;
use App\Models\Sale\Sale;
use Barryvdh\DomPDF\PDF;
use Illuminate\Http\Request;

class CustomerSalesReportController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $customers=Customer::all();
        return view("resources.report.customer.index", compact("customers"));

        //
    }

    public function store(Request $request){
        $request->validate([
            'from' => "required",
            'to' => "required",
             "customer_id"=>"required"
        ]);

        $from = $request->input("from");
        $to = $request->input("to");
        $customer_id = $request->input('customer_id');

        $salesTotal = Sale::with('salesItems')->where(["status" => "SUBMITED","customer_id"=>$customer_id])->whereDate('date', '>=', $from)->whereDate('date', '<=', $to)->sum('total_amount');
        // $expense_type = '';

        dd($salesTotal);


        $data = ['salesTotal' => $salesTotal];

        view()->share('resources.report.sales.report', $data);
        $pdf = PDF::loadView('resources.report.sales.report', $data);
        return $pdf->download('PROFIT REPORT.pdf');
    }
}
