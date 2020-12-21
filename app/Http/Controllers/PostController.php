<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function index()
    {
//        dd(Auth::user());

        $posts = Post::all();

        return response($posts, 200);
    }

    public function store(Request $request)
    {
//        dd($request->user());
        if(!auth()->user())
        {
            return response()->json([
               "message" => "You are not authorized"
            ], 401);
        }

        $this->validate($request, [
            'body' => 'required',
            'title' => 'required',
        ]);

        $request->user()->posts()->create([
            'title' => $request->title,
            'body' => $request->body,
        ]);

        return response()->json([
            "message" => "Post Created"
        ], 201);
    }

    public function details($id)
    {
        $post = Post::where('id', $id)->first();
        $comments = Comment::where('post_id', $id)->get();

        // dd($comments);

        return response([
            'post' => $post,
            'comments' => $comments,
        ], 200);
    }
}
