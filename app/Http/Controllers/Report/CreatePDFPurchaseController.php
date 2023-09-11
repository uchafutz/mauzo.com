<?php

namespace App\Http\Controllers\Report;

use App\Http\Controllers\Controller;
use App\Models\Purchase\Purchase;
use Barryvdh\DomPDF\Facade\Pdf as PDF;
use Illuminate\Http\Request;



class CreatePDFPurchaseController extends Controller
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
            "vendor_id" => "required",
            'from' => "required",
            'to' => "required",
        ]);
        $vendor_id = $request->input('vendor_id');
        $from = $request->input("from");
        $to = $request->input("to");
        $purchases = Purchase::with('items', 'warehouses')->where(["status" => "SUBMITED", "vendor_id" => $vendor_id])->whereDate('date', '>', $from)->whereDate('date', '<=', $to)->get();

        // share data to view
        $data =  ['purchases' => $purchases, 'from' => $from, 'to' => $to];
        view()->share('resources.report.purchase.report',$data);
        $pdf = PDF::loadView('resources.report.purchase.report', $data);
        // download PDF file with download method
        return $pdf->download('PURCHASE REPORT.pdf');
    }
}
