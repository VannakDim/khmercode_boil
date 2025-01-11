<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductModel;
use App\Models\ProductCategory;

class ProductController extends Controller
{
    public function index()
    {
        $models = ProductModel::all();
        $products = Product::all();
        return view('admin.product.index', compact('products','models'));
    }

    public function create()
    {
        $categories = ProductCategory::all();
        $models = ProductModel::all();
        return view('admin.product.create',compact('models','categories'));
    }
}
