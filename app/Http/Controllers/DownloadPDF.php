<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use PDF;



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
}
