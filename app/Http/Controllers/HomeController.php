<?php

namespace App\Http\Controllers;

use App\Models\About;
use App\Models\Post;
use App\Models\Tag;
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
        $posts = Post::where('status',"public")->get()->sortByDesc('id');
        $tags = Tag::all();
        return view('frontend.blog',compact('posts','tags'));
    }
    public function singleblog($id){
        $tags = Tag::all();
        $post = Post::find($id);
        return view('frontend.singleblog',compact('post','tags'));
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
