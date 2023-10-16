<?php

namespace App\Http\Controllers\Sale\Invoice;

use App\Http\Controllers\Controller;
use App\Models\Config\Organization;
use App\Models\Sale\Sale;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf as PDF;

class RequestInvoice extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request, Sale $sale, $type)
    {
        $organization = Organization::first();
        $pdf = PDF::loadView('resources.sale.sales.invoices.invoice', compact('organization', 'sale', 'type'));
        return $pdf->download();
    }
}