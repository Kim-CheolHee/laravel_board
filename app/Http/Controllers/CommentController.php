<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class CommentController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(Request $request, Post $post)
    {
        $request->validate([
            'content' => 'required',
        ]);

        $post->comments()->create([
            'user_id' => auth()->user()->id,
            'content' => $request->input('content'),
        ]);

        return back()->with('success', 'Comment posted.');
    }
}
