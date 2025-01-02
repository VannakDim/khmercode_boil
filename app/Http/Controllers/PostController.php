<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Tag;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::all();
        return view('admin.post.index', compact('posts'));
    }
    public function page_add()
    {
        $tags = Tag::all();
        return view('admin.post.add', compact('tags'));
    }
    public function page_edit($id)
    {
        $post = Post::find($id);
        $tags = Tag::all();
        return view('admin.post.edit', compact('post', 'tags'));
    }

    public function store(Request $request)
    {
        $validated=$request->validate([
            'title' => 'required',
            'tags' => 'nullable|array',
            'tags.*' => 'string|max:50',
            'description' => 'required',
            'content' => 'nullable',
            'status' => 'required',
            'is_featured' => 'nullable|boolean',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        // Create or fetch tags
        $tags = collect($validated['tags'])->map(function ($tagName) {
            return Tag::firstOrCreate(['name' => $tagName])->id;
        });
        $post = new Post();
        $post->title = $request->title;
        $post->description = $request->description;
        $post->status = $request->status;
        $post->content = $request->content;
        $post->is_featured = $request->featured?1:0;
        $post->user_id = Auth::user()->id;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('image/post/'), $name_gen);
            $post->image = 'image/post/' . $name_gen;
            // Simulate a long process (e.g., 5 seconds)
            // sleep(5);
        }
        $post->save();

        $post->tags()->sync($tags);

        return response()->json(['message' => 'Post created successfully.']);
    }

    public function update(Request $request, $id)
    {
        $validated=$request->validate([
            'title' => 'required',
            'status' => 'required',
            'tags' => 'required|array',
            'tags.*' => 'string|max:50',
            'description' => 'required',
            'content' => 'nullable',
            'is_featured' => 'nullable|boolean',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        // Create or fetch tags
        $tags = collect($validated['tags'])->map(function ($tagName) {
            return Tag::firstOrCreate(['name' => $tagName])->id;
        });
        $post = Post::find($id);
        $post->title = $request->title;
        $post->description = $request->description;
        $post->status = $request->status;
        $post->content = $request->content;
        $post->is_featured = $request->featured?1:0;
        $post->user_id = Auth::user()->id;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('image/post/'), $name_gen);
            $post->image = 'image/post/' . $name_gen;
        }
        $post->save();
        $post->tags()->sync($tags);
        return response()->json(['message' => 'Post updated successfully.']);
    }

    public function softDelete($id)
    {
        $post = Post::find($id);
        $post->delete();
        return redirect()->route('all.post');
    }
}
