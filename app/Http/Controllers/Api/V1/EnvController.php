<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Throwable;

class EnvController extends Controller
{
    /**
     * @OA\Get(
     *      path="/getEnvValues",
     *      tags={"envs"},
     *      summary="env값 가져오기",
     *      description="env값 가져오기",
     *      @OA\Response(
     *          response="200",
     *          description="Success",
     *      ),
     *      @OA\Response(
     *          response="400",
     *          description="Bad Request"
     *      ),
     *      @OA\Response(
     *          response="401",
     *          description="Anauthorized"
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request) {
        try {
            Log::info('envs', $request->all());
            $envs = [];
            foreach ($request->env_keys as $env_key) {
                $envs[$env_key] = env($env_key);
            }

            $sendData = [
                'status' => 'success',
                'message' => '성공',
                'data' => [
                    'envs' => $envs
                ]
            ];

            return response()->json($sendData, 200);
        } catch (Throwable $e) {
            report($e);

            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage() ?: 'Server Error'
            ], array_key_exists($e->getCode(), config('http.status_code')) ? $e->getCode() : 500);
        }
    }
}
