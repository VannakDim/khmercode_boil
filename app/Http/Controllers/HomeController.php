<?php

namespace App\Http\Controllers;

use App\Models\About;
use App\Models\Contact;
use App\Models\Services;
use App\Models\Team;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function home(){
        $about = About::first();
        $services = Services::all();
        return view('frontend.index',compact('about','services'));
    }
    public function blog(){
        
        return view('frontend.blog');
    }
    public function singleblog(){
        
        return view('frontend.singleblog');
    }

    public function about(){
        $about = About::first();
        $teams = Team::all()->sortBy('order');
        return view('frontend.about',compact('about','teams'));
    }

    public function contact(){
        $contact = Contact::all();
        return view('frontend.contact',compact('contact'));
    }
}
