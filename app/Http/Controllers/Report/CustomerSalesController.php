<?php

namespace App\Http\Controllers\Report;

use App\Http\Controllers\Controller;
use App\Models\Customer\Customer;
use App\Models\Sale\Sale;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf as PDF;

class CustomerSalesController extends Controller
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
             "customer_id"=>"required"
        ]);

        $from = $request->input("from");
        $to = $request->input("to");
        $customer_id = $request->input('customer_id');

        $salesTotal = Sale::with('salesItems')->where(["status" => "SUBMITED","customer_id"=>$customer_id])->whereDate('date', '>=', $from)->whereDate('date', '<=', $to)->sum('total_amount');
        $sales= Sale::with('salesItems')->where(["status" => "SUBMITED","customer_id"=>$customer_id])->whereDate('date', '>=', $from)->whereDate('date', '<=', $to)->get();
        $customer=Customer::find($customer_id)->first();
       // dd($sales);


        $data = ['salesTotal' => $salesTotal,"sales"=>$sales,"customer"=>$customer,"from"=>$from,"to"=>$to];

        view()->share('resources.report.customer.report', $data);
        $pdf = PDF::loadView('resources.report.customer.report', $data);
        return $pdf->download('CUSTOMER REPORT.pdf');
    }
}
