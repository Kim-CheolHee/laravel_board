<?php

namespace App\Http\Controllers;

use App\Models\BulletinBoard;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth')->only('create');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, BulletinBoard $bulletinBoard)
    {
        $page = $request->query('page', 1);
        $posts = $bulletinBoard->posts()->paginate(10, ['*'], 'page', $page);
        return view('posts.index', compact('bulletinBoard', 'posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(BulletinBoard $bulletinBoard)
    {
        return view('posts.create', compact('bulletinBoard'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, BulletinBoard $bulletinBoard)
    {
        $request->validate([
            'title' => 'required',
            'content' => 'required',
            'attachment' => 'file|mimes:jpeg,png,jpg,gif,svg,doc,docx,pdf,txt|max:2048',
        ]);

        $post = new Post([
            'title' => $request->input('title'),
            'content' => $request->input('content'),
            'user_id' => auth()->user()->id,
        ]);

        if ($request->hasFile('attachment')) {
            $attachment = $request->file('attachment');
            $attachmentName = time() . '-' . $attachment->getClientOriginalName();
            $attachment->storeAs('public/attachments', $attachmentName);
            $post->attachment = $attachmentName;
        }

        $bulletinBoard->posts()->save($post);

        return redirect()->route('posts.index', ['bulletinBoard' => $bulletinBoard->id])->with('success', 'Post created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $bulletinBoardId, $postId)
    {
        $post = Post::findOrFail($postId);
        $currentPage = $request->query('page', 1);
        return view('posts.show', compact('post', 'currentPage'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(BulletinBoard $bulletinBoard, Post $post)
    {
        return view('posts.edit', compact('bulletinBoard', 'post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, BulletinBoard $bulletinBoard, Post $post)
    {
        $request->validate([
            'title' => 'required',
            'content' => 'required',
        ]);

        $post->title = $request->input('title');
        $post->content = $request->input('content');
        $post->save();

        return redirect()->route('posts.show', ['bulletinBoard' => $bulletinBoard->id, 'post' => $post->id])
            ->with('success', 'Post updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(BulletinBoard $bulletinBoard, Post $post)
    {
        $post->delete();

        return redirect()->route('posts.index', $bulletinBoard->id)->with('success', '게시글이 삭제되었습니다.');
    }

}
