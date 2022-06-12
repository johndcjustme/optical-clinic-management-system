<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use PDF;


class UserController extends Controller
{
    // public function stor(Request $req) {
    //     $name = $req->input('name');
    // }
    // public function testRequest(Request $req){
    //     return $req->input();
    // }
    
    public function index(Request $req)
    {
      

        $pdf = PDF::loadView('download-pdf', ['orders' => Order::where('order_code', $request->code)->get()]);
        return $pdf->download( 'order-' . date('Y-m-d') . '.pdf'); 
    }
}
