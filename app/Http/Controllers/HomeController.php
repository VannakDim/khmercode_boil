<?php

namespace App\Http\Controllers;

use App\Models\About;
use App\Models\Contact;
use App\Models\Services;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function home(){
        $about = About::first();
        $services = Services::all();
        return view('frontend.index',compact('about','services'));
    }

    public function about(){
        $about = About::first();
        return view('frontend.about',compact('about'));
    }

    public function contact(){
        $contact = Contact::all();
        return view('frontend.contact',compact('contact'));
    }
}
