<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StockOutController extends Controller
{
    public function create()
    {
        return view('admin.product.stockout.create');
    }
}
