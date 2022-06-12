<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
// use PDF;
use Dompdf\Dompdf;




class DownloadPDF extends Controller
{
    public function index(Request $request)
    {
        return view('download-pdf', ['orders' => Order::where('order_code', $request->code)->get()]);
    }

    public function downloadPDF(Request $request)
    {
        $pdf = PDF::loadView('download-pdf', ['orders' => Order::where('order_code', $request->code)->get()]);
        return $pdf->download( 'order-' . date('Y-m-d') . '.pdf'); 
    }

    public function pdf()
    {
    //  $pdf = \App::make('dompdf.wrapper');
    $pdf = new Dompdf();

    //  $pdf->loadHTML($this->convert_customer_data_to_html());
     $pdf->loadHTML('hello world');
     $pdf->setPaper('A4', 'landscape');
    // return $pdf->render();
    return $pdf->stream();

    //  return $pdf->stream();
    }
}
