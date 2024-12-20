<?php

namespace App\Http\Controllers;

use App\Models\Services;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function index(){
        $services = Services::latest()->paginate(5);
        $trash = Services::onlyTrashed()->latest();
        return view('admin.service.index',compact('services','trash'));
    }

    public function add(){
        return view('admin.service.add');
    }
    public function edit($id){
        $services = Services::find($id);
        return view('admin.service.edit',compact('services'));
    }
    public function update(Request $request, $id){
        $validated = $request->validate([
            'service_name' => 'required|max:50',
        ],
        [
            'service_name.required'=>'សូមបញ្ចូលឈ្មោះសេវាកម្ម',
        ]);

        $old_image = $request->old_image;
        $service_image = $request->file('image');
        if($service_image){
            $name_gen = hexdec(uniqid());
            $img_ext = strtolower($service_image->getClientOriginalExtension());
            $image_name = $name_gen .'.'. $img_ext;
            $up_location = 'image/service/';
            $last_img = $up_location.$image_name;
            $service_image->move($up_location,$image_name);
            unlink($old_image);
            $image = $request->file('image');
            Services::find($id)->update([
                'service_name' => $request->service_name,
                'short_description' => $request->short_description,
                'long_description' => $request->long_description,
                'service_icon' => $last_img,
            ]);
            return Redirect()->route('all.service')->with('success','Service updated successfull!');
        }else{
            Services::find($id)->update([
                'service_name' => $request->service_name,
                'short_description' => $request->short_description,
                'long_description' => $request->long_description,
            ]);
            return Redirect()->route('all.service')->with('success','Service updated successfull!');
        }
    }

    
    public function store(Request $request){
        $validated = $request->validate([
            'service_name' => 'required|unique:Services|max:25',
        ],
        [
            'service_name.required'=>'សូមបញ្ចូលឈ្មោះសេវាកម្ម',
        ]);
        
        $image = $request->file('image');
        $name_gen = hexdec(uniqid());
        $img_ext = strtolower($image->getClientOriginalExtension());
        $image_name = $name_gen .'.'. $img_ext;
        $up_location = 'image/services/';
        $last_img = $up_location.$image_name;
        $image->move($up_location,$image_name);
        
        Services::insert([
            'service_name'=> $request->service_name,
            'short_description'=> $request->short_description,
            'long_description'=> $request->long_description,
            'service_icon'=> $last_img,
            'created_at'=> Carbon::now()
        ]);
        return Redirect()->back()->with('success','Service inserted successfull.' );
    }


    public function softDelete($id){
        Services::find($id)->delete();
        return Redirect()->back()->with('success','Service has been moved to trash.');
    }
}
