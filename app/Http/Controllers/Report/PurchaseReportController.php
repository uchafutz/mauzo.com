<?php

namespace App\Http\Controllers\Report;

use App\Http\Controllers\Controller;
use App\Models\Purchase\Purchase;
use App\Models\Vendor\Vendor;
use Barryvdh\DomPDF\PDF;
use Illuminate\Http\Request;

class PurchaseReportController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $vendors = Vendor::all();
        return view("resources.report.purchase.index", compact("vendors"));
    }
}
