<?php

namespace App\Http\Controllers;

use App\Models\About;
use App\Models\AboutItem;
use Illuminate\Http\Request;


class AboutController extends Controller
{
    public function about_item(){
        $item = AboutItem::all();
        return response()->json([
            'status' => 200,
            'item' => $item
        ]);
    }

    public function index(Request $request){
        $abouts = About::first();
        $trash = About::onlyTrashed()->latest();
        return view('admin.about.index',compact('abouts','trash'));
        
    }

    public function add(){
        return view('admin.about.add');
    }

    public function edit($id){
        $abouts = About::find($id);
        $items = AboutItem::all();
        return view('admin.about.edit',compact('abouts','items'));
    }

    public function update(Request $request, $id){
        $validated = $request->validate([
            'title' => 'required|max:50',
        ],
        [
            'title.required'=>'សូមបញ្ចូលឈ្មោះ',
        ]);

        $old_image = $request->old_image;
        $image = $request->file('image');
        if($image){
            $name_gen = hexdec(uniqid());
            $img_ext = strtolower($image->getClientOriginalExtension());
            $image_name = $name_gen .'.'. $img_ext;
            $up_location = 'image/about/';
            $last_img = $up_location.$image_name;
            $image->move($up_location,$image_name);
            unlink($old_image);
            About::find($id)->update([
                'title' => $request->title,
                'image' => $last_img,
                'short_description' => $request->short_description,
                'long_description'=> $request->long_description,
                'more_description'=>'<p class="kh-battambang"'. substr($request->more_description,3),
            ]);
            return Redirect()->route('all.about')->with('success','About updated successfull!');
        }else{
            About::find($id)->update([
                'title' => $request->title,
                'short_description' => $request->short_description,
                'long_description'=> $request->long_description,
                'more_description'=> substr($request->more_description,3),
            ]);
            return Redirect()->route('all.about')->with('success','About updated successfull!');
        }
        
    
    }
}
