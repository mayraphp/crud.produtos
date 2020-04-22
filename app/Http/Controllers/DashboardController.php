<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $data = Product::paginate(10);
        return view('welcome', [
            'data' =>$data,
        ]);
    }
}
