<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function index()
    {
        $posts = Post::where('user_id', Auth::id())->simplePaginate(4);

        return view('profile.index', [
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

    public function details($id)
    {
        $post = Post::where('id', $id)->first();
        $comments = Comment::where('post_id', $id)->get();

        // dd($comments);

        return view('posts.details', [
            'post' => $post,
            'comments' => $comments,
        ]);
    }
    
    public function update(Request $request, Post $post)
    {
        $post->title = $request->newTitle;
        $post->body = $request->newBody;
        $post->save();

        return back();
    }

    public function destroy(Post $post)
    {
        $post->delete();

        return redirect(route('profile'));
    }
}
