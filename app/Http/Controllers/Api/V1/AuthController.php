<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Throwable;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\JWTAuth;

class AuthController extends Controller
{

/**
 * @OA\Post(
 *     path="/api/v1/login",
 *     tags={"/login"},
 *     summary="로그인",
 *     description="로그인",
 *     @OA\RequestBody(
 *         required=true,
 *         description="Login data",
 *         @OA\JsonContent(
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
 *         response=200,
 *         description="User logged in successfully",
 *         @OA\JsonContent(
 *             @OA\Property(
 *                 property="status",
 *                 type="string",
 *                 example="success"
 *             ),
 *             @OA\Property(
 *                 property="message",
 *                 type="string",
 *                 example="성공"
 *             ),
 *             @OA\Property(
 *                 property="data",
 *                 type="object",
 *                 @OA\Property(
 *                     property="access_token_name",
 *                     type="string",
 *                     example="X-ACCESS-TOKEN"
 *                 ),
 *                 @OA\Property(
 *                     property="access_token",
 *                     type="string"
 *                 ),
 *             )
 *         )
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
 *
 * @param \Illuminate\Http\Request $request
 * @return \Illuminate\Http\JsonResponse
 */
    public function login(Request $request)
    {
        // 요청 확인
        if (!Auth::attempt($request->only('email', 'password')))
        {
            return response()->json([
                'message' => '잘못된 로그인 정보'
            ], 401);
        }

        $user = Auth::user();
        $token = $user->createToken('token')->plainTextToken;

        return response()->json([
            'user' => $user,
            'token' => $token,
        ]);
    }
    // public function login(Request $request)
    // {
    //     $credentials = $request->only('email', 'password');

    //     try {
    //         if (! $token = JWTAuth::attempt($credentials)) {
    //             return response()->json(['error' => 'invalid_credentials'], 400);
    //         }
    //     } catch (JWTException $e) {
    //         return response()->json(['error' => 'could_not_create_token'], 500);
    //     }

    //     return response()->json(compact('token'));
    // }

    /**
     * @OA\Post(
     *      path="/api/v1/logout",
     *      tags={"/logout"},
     *      summary="로그아웃",
     *      description="로그아웃",
     *      @OA\Response(
     *          response="200",
     *          description="Success",
     *          @OA\JsonContent(
     *              @OA\Property(
     *                  property="status",
     *                  type="string",
     *                  example="success"
     *              ),
     *              @OA\Property(
     *                  property="message",
     *                  type="string",
     *                  example="성공"
     *              ),
     *              @OA\Property(
     *                  property="data",
     *                  type="object",
     *                  @OA\Property(
     *                      property="access_token_name",
     *                      type="string",
     *                      example="X-ACCESS-TOKEN"
     *                  ),
     *              ),
     *          )
     *      ),
     *      @OA\Response(
     *          response="400",
     *          description="Bad request"
     *      ),
     *      @OA\Response(
     *          response="401",
     *          description="Unauthorized"
     *      ),
     *      @OA\Response(
     *          response="500",
     *          description="Server Error"
     *      ),
     *      security={
     *          {"bearerAuth": {}}
     *      }
     * )
     *
     * @return \Illuminate\Http\JsonResponse
     */
    // public function logout(Request $request)
    // {
    //     if ($request->user()) {
    //         $request->user()->currentAccessToken()->delete();
    //         return response()->json([
    //             'message' => 'Logged out'
    //         ]);
    //     }

    //     return response()->json([
    //         'message' => 'Unauthenticated'
    //     ], 401);
    // }
    // public function logout(Request $request) {
    //     $token = $request->header('Authorization');

    //     try {
    //         JWTAuth::invalidate($token);
    //         return response()->json(['message' => 'Logout successfully'], 200);
    //     } catch (JWTException $e) {
    //         return response()->json(['error' => 'Failed to logout, please try again.'], 500);
    //     }
    // }
    public function logout(Request $request)
    {
        try {
            // 사용자가 인증되었는지 확인
            if (!$request->user()) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Unauthenticated: No valid user found'
                ], 401);
            }

            // 사용자의 현재 액세스 토큰 삭제
            $request->user()->currentAccessToken()->delete();

            return response()->json([
                'status' => 'success',
                'message' => 'Logged out',
                'data' => [
                    'access_token_name' => 'X-ACCESS-TOKEN', // JWT를 사용하지 않으므로 이름은 임의
                ]
            ]);
        } catch (Throwable $e) {
            report($e);

            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage() ?: 'Server Error'
            ], $e->getCode() >= 100 && $e->getCode() < 600 ? $e->getCode() : 500);
        }
    }
}
