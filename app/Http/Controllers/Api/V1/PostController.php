<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\BulletinBoard;
use Illuminate\Http\Request;

use App\Models\Post;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class PostController extends Controller
{

/**
 * @OA\Get(
 *     path="/api/v1/bulletin-boards/{bulletin_board_id}/posts",
 *     tags={"/boards"},
 *     summary="게시글 리스트 가져오기",
 *     description="특정 게시판의 게시글 리스트를 가져옵니다.",
 *     @OA\Parameter(
 *         name="bulletin_board_id",
 *         in="path",
 *         description="게시판 ID",
 *         required=true,
 *         @OA\Schema(
 *             type="integer"
 *         )
 *     ),
 *
 *     @OA\Response(
 *         response=201,
 *         description="게시글 리스트를 가져오는데 성공했습니다.",
 *         @OA\JsonContent(ref="#/components/schemas/PostResource")
 *
 *     ),
 *     @OA\Response(
 *         response=401,
 *         description="Unauthorized"
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="Not Found"
 *     ),
 *     @OA\Response(
 *         response=500,
 *         description="Server Error"
 *     ),
 *    security={
 *         {"bearerAuth": {}}
 *     }
 * )
 */
    public function index(BulletinBoard $bulletinBoard)
    {
        return response()->json($bulletinBoard->posts, 200);
    }

/**
  * @OA\Post(
  *     path="/api/v1/bulletin-boards/{bulletin_board_id}/posts",
  *     tags={"/boards"},
  *     summary="게시판 아이디로 게시글 생성하기",
  *     description="게시판 아이디로 게시글을 생성합니다.",
  *     @OA\Parameter(
  *         name="bulletin_board_id",
  *         in="path",
  *         description="Board ID",
  *         required=true,
  *         @OA\Schema(
  *             type="integer"
  *         )
  * ),
  * @OA\RequestBody(
  *     required=true,
  *     description="작성할 게시글의 내용을 입력하세요.",
  *     @OA\JsonContent(ref="#/components/schemas/PostResource")
  * ),
  * @OA\Response(
  *     response=201,
  *     description="게시글 생성에 성공했습니다.",
  *     @OA\JsonContent(ref="#/components/schemas/PostResource")
  * ),
  * @OA\Response(
  *     response=404,
  *     description="Not found"
  * ),
  * @OA\Response(
  *     response=400,
  *     description="Invalid input"
  * ),
  * @OA\Response(
  *     response=500,
  *     description="Server error"
  * ),
  * security={
  *     {"bearerAuth": {}}
  * }
  *)
  */
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

/**
 * @OA\Get(
 * path="/api/v1/bulletin-boards/{bulletin_board_id}/posts/{post_id}",
 * tags={"/boards"},
 * summary="게시판 아이디와 게시글 아이디로 게시글 가져오기",
 * description="제공받은 게시판 아이디와 게시글 아이디로 게시글을 가져옵니다.",
 *     @OA\Parameter(
 *         name="bulletin_board_id",
 *         in="path",
 *         description="게시판 ID",
 *         required=true,
 *         @OA\Schema(
 *             type="integer"
 *         )
 *     ),
 *    @OA\Parameter(
 *         name="post_id",
 *         in="path",
 *         description="게시글 ID",
 *         required=true,
 *         @OA\Schema(
 *             type="integer"
 *         )
 *     ),
 * @OA\Response(
 * response=200,
 * description="게시글을 가져오는데 성공했습니다.",
 * @OA\JsonContent(ref="#/components/schemas/PostResource")
 * ),
 * @OA\Response(
 * response=404,
 * description="User not found"
 * ),
 * @OA\Response(
 * response=400,
 * description="Invalid input"
 * ),
 * @OA\Response(
 * response=500,
 * description="Server error"
 * ),
 *   security={
 *         {"bearerAuth": {}}
 *     }
 *)
 */
    public function show(BulletinBoard $bulletinBoard, $id)
    {
        try {
            $post = $bulletinBoard->posts()->findOrFail($id);
            return response()->json($post, 200);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Post not found'], 404);
        }
    }

/**
 * @OA\Patch(
 * path="/api/v1/bulletin-boards/{bulletin_board_id}/posts/{post_id}",
 * tags={"/boards"},
 * summary="게시판 아이디와 게시글 아이디로 게시글 업데이트하기",
 * description="게시판 아이디와 게시글 아이디로 게시글을 업데이트합니다.",
 *     @OA\Parameter(
 *         name="bulletin_board_id",
 *         in="path",
 *         description="게시판 ID",
 *         required=true,
 *         @OA\Schema(
 *             type="integer"
 *         )
 *     ),
 *    @OA\Parameter(
 *         name="post_id",
 *         in="path",
 *         description="게시글 ID",
 *         required=true,
 *         @OA\Schema(
 *             type="integer"
 *         )
 *     ),
 * @OA\RequestBody(
 * required=true,
 * description="바꿀 부분을 수정하세요.",
 *   @OA\JsonContent(
 *     @OA\Property(property="title", type="string", example="New Title"),
 *     @OA\Property(property="content", type="string", example="New content for the post.")
 *   )
 * ),
 * @OA\Response(
 * response=200,
 * description="게시글 업데이트에 성공했습니다.",
 * @OA\JsonContent(ref="#/components/schemas/PostResource")
 * ),
 * @OA\Response(
 * response=404,
 * description="User not found"
 * ),
 * @OA\Response(
 * response=400,
 * description="Invalid input"
 * ),
 * @OA\Response(
 * response=500,
 * description="Server error"
 * ),
 *   security={
 *         {"bearerAuth": {}}
 *     }
 *)
 */
    public function update(Request $request, BulletinBoard $bulletinBoard, $id)
    {

        // 게시글 수정 시 게시글의 작성자와 인증된 사용자가 같은지 확인
        $request->validate([
            'title' => 'required|string',
            'content' => 'required|string',
        ]);

        try {
            $post = $bulletinBoard->posts()->findOrFail($id);
            $post->update($request->all());
            Log::info('Request data:', $request->all());
            return response()->json($post, 200);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Post not found'], 404);
        }
    }

/**
  * @OA\Delete(
  * path="/api/v1/bulletin-boards/{bulletin_board_id}/posts/{post_id}",
  * tags={"/boards"},
  * summary="게시판 아이디와 게시글 아이디로 게시글 삭제하기",
  * description="게시판 아이디와 게시글 아이디로 게시글을 삭제합니다",
  * @OA\Parameter(
  *     name="bulletin_board_id",
  *     in="path",
  *     description="Board ID",
  *     required=true,
  *     @OA\Schema(
  *         type="integer"
  *     )
  * ),
  * @OA\Parameter(
  *     name="post_id",
  *     in="path",
  *     description="Post ID",
  *     required=true,
  *     @OA\Schema(
  *         type="integer"
  *     )
  * ),
  * @OA\Response(
  *     response=200,
  *     description="게시글 삭제에 성공했습니다",
  *     @OA\JsonContent(
  *         @OA\Property(property="status", type="string", example="Post deleted successfully")
  *     )
  * ),
  * @OA\Response(
  *     response=404,
  *     description="Post not found"
  * ),
  * @OA\Response(
  *     response=400,
  *     description="Invalid input"
  * ),
  * @OA\Response(
  *     response=500,
  *     description="Server error"
  * ),
  * security={
  *     {"bearerAuth": {}}
  * }
  *)
  */
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
