<?php

namespace App\Http\Controllers;

use App\Models\BulletinBoard;
use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;

class CommentController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(Request $request)
    {
        $request->validate([
            'content' => 'required',
            'post_id' => 'required',
        ]);

        $comment = new Comment();
        $comment->content = $request->content;
        $comment->post_id = $request->post_id;
        $comment->user_id = auth()->id(); // user_id를 현재 인증된 사용자의 id로 설정
        $comment->save();

        return redirect()->back();
    }

    public function edit(Comment $comment)
    {
        // 인증된 사용자가 댓글 작성자인지 확인
        if (auth()->id() !== $comment->user_id) {
            return redirect()->back()->with('error', '댓글 수정 권한이 없습니다.');
        }
        return view('comments.edit', compact('comment'));
    }

    public function update(Request $request, BulletinBoard $bulletinBoard, Post $post, Comment $comment)
    {
        // 인증된 사용자가 댓글 작성자인지 확인
        if (auth()->id() !== $comment->user_id) {
            return redirect()->back()->with('error', '댓글 수정 권한이 없습니다.');
        }

        $request->validate([
            'content' => 'required',
        ]);

        $comment->content = $request->content;
        $comment->save();

        return redirect()->route('posts.show', ['bulletinBoard' => $bulletinBoard->id, 'post' => $post->id]);
    }

    public function destroy(BulletinBoard $bulletinBoard, Post $post, Comment $comment)
    {
        // 인증된 사용자가 댓글 작성자인지 확인
        if (auth()->id() !== $comment->user_id) {
            return redirect()->back()->with('error', '댓글 삭제 권한이 없습니다.');
        }
        $comment->delete();

        return redirect()->route('posts.show', ['bulletinBoard' => $bulletinBoard->id, 'post' => $post->id])
        ->with('성공', '댓글 삭제 성공.');
    }
}
