<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\BulletinBoard;
use Illuminate\Http\Request;

use App\Models\Post;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function index(BulletinBoard $bulletinBoard)
    {
        return response()->json($bulletinBoard->posts, 200);
    }

    public function store(Request $request, BulletinBoard $bulletinBoard)
    {
        $post = new Post();
        $post->title = $request->title;
        $post->content = $request->content;
        $post->published_at = $request->published_at;
        $post->bulletin_board_id = $bulletinBoard->id;
        $post->user_id = auth()->id(); // 인증된 사용자의 ID에 user_id를 할당
        $post->save();

        return response()->json($post, 201);
    }

    public function show(BulletinBoard $bulletinBoard, $id)
    {
        try {
            $post = $bulletinBoard->posts()->findOrFail($id);
            return response()->json($post, 200);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Post not found'], 404);
        }
    }

    public function update(Request $request, BulletinBoard $bulletinBoard, $id)
    {
        try {
            $post = $bulletinBoard->posts()->findOrFail($id);
            $post->update($request->all());
            return response()->json($post, 200);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Post not found'], 404);
        }
    }

    public function destroy(BulletinBoard $bulletinBoard, $id)
    {
        try {
            $post = $bulletinBoard->posts()->findOrFail($id);
            $post->delete();
            return response()->json(['status' => 'Post deleted successfully'], 200);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Post not found'], 404);
        }
    }
}
