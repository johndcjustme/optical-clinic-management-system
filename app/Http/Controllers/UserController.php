<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function stor(Request $req) {
        $name = $req->input('name');
    }
    public function testRequest(Request $req){
        return $req->input();
    }
}
