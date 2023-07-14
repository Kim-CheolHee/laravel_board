<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;

/**
 * @OA\Info(title="board", version="0.1")
 **/
/**
 * @OA\Info(
 *      version="1.0.0",
 *      title="board Rest API",
 *      description="board API",
 *      @OA\Contact(
 *          email="chkim@dtwocorp.com"
 *      )
 * )
 *
 * @OA\Server(
 *      url="",
 *      description=""
 * )
 *
 * @OA\SecurityScheme(
 *      securityScheme="bearerAuth",
 *      in="header",
 *      name="bearerAuth",
 *      type="http",
 *      scheme="bearer",
 *      bearerFormat="JWT",
 * )
 */

class UserController extends Controller
{

/**
 * @OA\Get(
 *     path="/api/v1/users",
 *     tags={"/users"},
 *     summary="유저 목록 가져오기",
 *     description="제공된 필터와 일치하는 모든 사용자 또는 사용자의 리턴 목록",
 *     @OA\Parameter(
 *         name="name",
 *         in="query",
 *         description="이름 필터",
 *         required=false,
 *         @OA\Schema(
 *             type="string"
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Successful operation",
 *         @OA\JsonContent(ref="#/components/schemas/UserResource")
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="Users not found"
 *     ),
 *     @OA\Response(
 *         response=500,
 *         description="Server Error"
 *     ),
 *     security={
 *         {"bearerAuth": {}}
 *     }
 * )
 */
    public function index(Request $request)
    {
        try {
            if( $request->name ) {
                $users = User::where('name', 'like', "%{$request->name}%")->get();
            }
            else {
                $users = User::all();
            }

            if(count($users) === 0) {
                return response()->json(['error' => 'No users found'], 404);
            }
            return response()->json([
                'status' => 'success',
                'message' => '성공',
                'data' => [
                    'users' => UserResource::collection($users)
                ]
            ]);
        }
        catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'User not found'], 404);
        }
        catch (\Exception $e) {
            return response()->json(['error' => 'Failed to retrieve users'], 500);
        }
    }

/**
 * @OA\Post(
 *     path="/api/v1/users",
 *     tags={"/users"},
 *     summary="새로운 유저 생성",
 *     description="새로운 유저를 생성하고 사용자 데이터를 반환합니다.",
 *     @OA\RequestBody(
 *         required=true,
 *         description="User data",
 *         @OA\JsonContent(
 *             @OA\Property(
 *                 property="name",
 *                 type="string"
 *             ),
 *             @OA\Property(
 *                 property="email",
 *                 type="string",
 *                 format="email"
 *             ),
 *             @OA\Property(
 *                 property="password",
 *                 type="string",
 *                 format="password"
 *             )
 *         )
 *     ),
 *     @OA\Response(
 *         response=201,
 *         description="User created successfully",
 *         @OA\JsonContent(ref="#/components/schemas/UserResource")
 *     ),
 *     @OA\Response(
 *         response=400,
 *         description="Invalid input"
 *     ),
 *     @OA\Response(
 *         response=500,
 *         description="Server Error"
 *     )
 * )
 */

    public function store(Request $request)
    {
        $user = User::create($request->all());
        return response()->json($user, 201);
    }


/**
  * @OA\Get(
  * path="/api/v1/users/{email}",
  * tags={"/users"},
  * summary="이메일로 유저 정보 가져오기",
  * description="유저 데이터를 이메일로 가져오고 리턴합니다.",
  * @OA\Parameter(
  * name="email",
  * in="path",
  * description="유저의 이메일",
  * required=true,
  * @OA\Schema(
  * type="string",
  * format="email"
  * )
  * ),
  * @OA\Response(
  * response=200,
  * description="Successful operation",
  * @OA\JsonContent(ref="#/components/schemas/UserResource")
  * ),
  * @OA\Response(
  * response=404,
  * description="User not found"
  * ),
  * @OA\Response(
  * response=500,
  * description="Server error"
  * )
  *)
  */
    public function show($email)
    {
        try {
            $user = User::where('email', $email)->firstOrFail();
            return response()->json($user, 200);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'User not found'], 404);
        }
    }

/**
  * @OA\Patch(
  * path="/api/v1/users/{email}",
  * tags={"/users"},
  * summary="이메일로 유저 정보 업데이트하기",
  * description="제공받은 이메일로 유저 정보를 업데이트하고 리턴합니다.",
  * @OA\Parameter(
  * name="email",
  * in="path",
  * description="유저의 이메일",
  * required=true,
  * @OA\Schema(
  * type="string",
  * format="email"
  * )
  * ),
  * @OA\RequestBody(
  * required=true,
  * description="새로운 유저 데이터",
  * @OA\JsonContent(ref="#/components/schemas/UserResource")
  * ),
  * @OA\Response(
  * response=200,
  * description="User updated successfully",
  * @OA\JsonContent(ref="#/components/schemas/UserResource")
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
  * )
  *)
  */

    public function update(Request $request, $email)
    {
        try {
            $user = User::where('email', $email)->firstOrFail();
            $user->update($request->all());
            return response()->json($user, 200);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'User not found'], 404);
        }
    }

/**
  * @OA\Delete(
  * path="/api/v1/users/{email}",
  * tags={"/users"},
  * summary="유저 삭제하기",
  * description="제공받은 이메일로 유저를 삭제합니다.",
  * @OA\Parameter(
  * name="email",
  * in="path",
  * description="The email of the user",
  * required=true,
  * @OA\Schema(
  * type="string",
  * format="email"
  * )
  * ),
  * @OA\Response(
  * response=200,
  * description="User deleted successfully",
  * @OA\JsonContent(
  * @OA\Property(
  * property="Status",
  * type="string",
  * example="User deleted successfully"
  * )
  * )
  * ),
  * @OA\Response(
  * response=404,
  * description="User not found"
  * ),
  * @OA\Response(
  * response=500,
  * description="Server error"
  * )
  *)
  */

    public function destroy($email)
    {
        try {
            $user = User::where('email', $email)->firstOrFail();
            $user->delete();
            return response()->json(['status' => 'User deleted successfully'], 200);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'User not found'], 404);
        }
    }

}
