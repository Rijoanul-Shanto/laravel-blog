<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::simplePaginate(2);

        return view('posts.index', [
            'posts' => $posts,
        ]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'body' => 'required',
            'title' => 'required',
        ]);

        $request->user()->posts()->create([
            'title' => $request->title,
            'body' => $request->body,
        ]);

        return back();
    }
}
