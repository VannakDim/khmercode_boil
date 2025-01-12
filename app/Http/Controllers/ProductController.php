<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductModel;
use App\Models\ProductCategory;
use App\Models\StockIn;
use App\Models\StockInDetail;

class ProductController extends Controller
{
    public function index()
    {
        // $models = ProductModel::all();
        // $products = Product::all();
        // $stocks = StockInDetail::all();
        // return view('admin.product.index', compact('products','models','stocks'));

        $data = ProductModel::with('brand')->get()->map(function ($model) {
            $stockIn = StockInDetail::where('product_model_id', $model->id)->sum('quantity');
            return [
                'id' => $model->id,
                'model_name' => $model->name,
                'brand_name' => $model->brand->brand_name,
                'available_stock' => $stockIn,
            ];
        });
        return view('admin.product.index', compact('data'));

        // return response()->json(['data'=>$data]);
    }

    public function create()
    {
        $categories = ProductCategory::all();
        $models = ProductModel::all();
        return view('admin.product.create',compact('models','categories'));
    }
}
