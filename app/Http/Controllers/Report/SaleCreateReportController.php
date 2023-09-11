<?php

namespace App\Http\Controllers\Report;

use App\Http\Controllers\Controller;
use App\Models\Sale\Sale;
use Illuminate\Http\Request;

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
        //
        $request->validate([
            'from' => "required",
            'to' => "required",

        ]);

        $from = $request->input("from");
        $to = $request->input("to");
        $sales = Sale::with('salesItems')->where(["status" => "SUBMITED"])->whereDate('date', '>', $from)->whereDate('date', '<=', $to)->get();

        // dd($sales);
    }
}
