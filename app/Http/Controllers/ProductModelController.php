<?php

namespace App\Http\Controllers;

use App\Models\ProductBrand;
use Illuminate\Http\Request;
use App\Models\ProductModel;
use App\Models\ProductCategory;

class ProductModelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = ProductCategory::all();
        $brands = ProductBrand::all();
        return view('admin.product.model.create', compact('brands', 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'categories' => 'required|array',
            'categories.*' => 'string|max:50',
            'brands' => 'required|array',
            'name' => 'required',
            'frequency' => 'nullable',
            'type' => 'nullable',
            'capacity' => 'nullable',
            'power' => 'nullable',
            'description' => 'nullable',

        ]);

        // Create or fetch categories
        $category = collect($validated['categories'])->map(function ($categoryName) {
            return ProductCategory::firstOrCreate(['name' => $categoryName])->id;
        })->first();
        // Create or fetch brands
        $brand = collect($validated['brands'])->map(function ($brandName) {
            return ProductBrand::firstOrCreate(['brand_name' => $brandName])->id;
        })->first();
       
        $model = new ProductModel();
        $model->category_id = $category;
        $model->brand_id = $brand;
        $model->name = $request->name;
        $model->frequency = $request->frequency;
        $model->type = $request->type;
        $model->capacity = $request->capacity;
        $model->power = $request->power;
        $model->description = $request->description;

        $model->save();
        return response()->json(['message' => 'Model created successfully.']);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
