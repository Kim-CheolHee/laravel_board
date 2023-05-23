<?php

namespace App\Http\Controllers;

use App\Models\BulletinBoard;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
        $posts = $bulletinBoard->posts()->orderBy('published_at', 'desc')->paginate(10, ['*'], 'page', $page);
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
            'attachments.*' => 'file|mimes:jpeg,png,jpg,gif,svg,doc,docx,pdf,txt|max:2048',
        ]);

        $post = $bulletinBoard->posts()->create([
            'title' => $request->input('title'),
            'content' => $request->input('content'),
            'user_id' => auth()->user()->id,
            'published_at' => now(),
        ]);

        if ($request->hasFile('attachments')) {
            foreach ($request->file('attachments') as $attachment) {
                $attachmentName = time() . '-' . $attachment->getClientOriginalName();
                $file_path = 'public/attachments';
                $attachment->storeAs($file_path, $attachmentName);
                $post->attachments()->create([
                    'file_path' => $attachmentName,
                ]);
            }
        }

        return redirect()->route('posts.index', ['bulletinBoard' => $bulletinBoard->id])->with('success', 'Post created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, BulletinBoard $bulletinBoard, Post $post)
    {
        $attachments = $post->attachments->map(function ($attachment) {
            return $attachment->file_path;
        });

        $currentPage = $request->query('page', 1);
        return view('posts.show', compact('post', 'currentPage', 'attachments', 'bulletinBoard'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(BulletinBoard $bulletinBoard, Post $post)
    {
        $attachments = $post->attachments;
        return view('posts.edit', compact('bulletinBoard', 'post', 'attachments'));
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
            'attachments.*' => 'sometimes|file|mimes:jpeg,png,jpg,gif,svg,doc,docx,pdf,txt|max:2048',
        ]);

        $post->title = $request->input('title');
        $post->content = $request->input('content');
        $post->save();

        // 첨부파일 수정
        if ($request->hasFile('attachments')) {
            foreach ($request->file('attachments') as $attachment) {
                $attachmentName = time() . '-' . $attachment->getClientOriginalName();
                $file_path = 'public/attachments';
                $attachment->storeAs($file_path, $attachmentName);
                $post->attachments()->create([
                    'file_path' => $attachmentName,
                ]);
            }
        }

        // 첨부파일 삭제
        if ($request->input('deleted_attachments')) {
            foreach ($request->input('deleted_attachments') as $id) {
                $attachment = $post->attachments()->find($id);
                if ($attachment) {
                    Storage::delete('public/attachments/' . $attachment->file_path); // storage에서 삭제
                    $attachment->delete(); // database에서 행 삭제
                }
            }
        }

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
