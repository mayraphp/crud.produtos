<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $data = Product::all();
        return view('welcome', [
            'data' =>$data,
        ]);
    }
}
