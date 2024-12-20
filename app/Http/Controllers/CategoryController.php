<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;

class CategoryController extends Controller
{
    public function index(){
        $categories = Category::latest()->paginate(5);
        $trashCat = Category::onlyTrashed()->latest()->paginate(3);
        return view('admin.category.index',compact('categories','trashCat'));
    }
    public function edit($id){
        $categories = Category::find($id);
        return view('admin.category.edit',compact('categories'));
    }
    public function update(Request $request, $id){
        $cat_id = Category::find($id)->update([
            'category_id' => $request->category_name,
            'user_id' => Auth::user()->id,
        ]);

        return Redirect()->route('all.category')->with('success','Category updated successfull!');
    }

    
    public function store(Request $request){
        $validated = $request->validate([
            'category_name' => 'required|unique:categories|max:25',
        ],
        [
            'category_name.required'=>'សូមបញ្ចូលឈ្មោះកាតាឡុក',
        ]);

        Category::insert([
            'category_name'=> $request->category_name,
            'user_id'=> Auth::user()->id,
            'created_at'=> Carbon::now()
        ]);
        return Redirect()->back()->with('success','Category inserted successfull.' );
    }

    public function softDelete($id){
        $delete = Category::find($id)->delete();
        return Redirect()->back()->with('success','Category has been moved to trash.');
    }
    
}
