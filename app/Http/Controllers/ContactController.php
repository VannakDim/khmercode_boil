<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function edit(){
        $contact = Contact::first();
        if(!$contact){
            $contact = new Contact();
            $contact->save();
        }
        return view('admin.contact.edit',compact('contact'));
    }

    public function update(Request $request){
        $contact = Contact::first();
        $contact->update([
            'phone' => $request->phone,
            'email' => $request->email,
            'address' => $request->address,
            'map' => $request->map,
            'telegram' => $request->telegram,
            'facebook' => $request->facebook,
            'twitter' => $request->twitter,
            'linkedin' => $request->linkedin,
            'instagram' => $request->instagram,
            'youtube' => $request->youtube,
        ]);
        return back()->with('success','Contact Information Updated Successfully');
    }
}
