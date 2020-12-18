<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request, $id)
    {
        $this->validate($request, [
            'body' => 'required',
        ]);
        
        $request->user()->comments()->create([
            'post_id' => $id,
            'body' => $request->body,
        ]);

        return back();
    }
}
