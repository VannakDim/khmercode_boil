<?php
namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Tag;
use App\Models\Comment;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $query = $request->input('q'); // Get the search term
        $results = [];

        if ($query) {
            // Search Posts
            $posts = Post::where('title', 'LIKE', "%{$query}%")
                ->orWhere('description', 'LIKE', "%{$query}%")
                ->orWhere('content', 'LIKE', "%{$query}%")
                ->get();

            // Search Tags
            $tags = Tag::where('name', 'LIKE', "%{$query}%")->get();

            // Search Comments
            // $comments = Comment::where('content', 'LIKE', "%{$query}%")->get();

            // Combine Results
            $results = [
                'posts' => $posts,
                'tags' => $tags,
                // 'comments' => $comments,
            ];
            return view('frontend.blog_search', compact('results', 'query'));
        }
        return redirect()->back();

    }
}