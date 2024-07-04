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

   
}
