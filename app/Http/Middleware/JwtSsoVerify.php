<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JwtSsoVerify
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, $guard)
    {
        $auth = Auth::guard($guard);

        if (!$auth->check()) {
            return response()->json([
                'message' => 'Unauthorized'
            ], 401);
        }

        $auth->setRequest($request);

        // $id = $auth->payload()->get('sub');
        $email = $auth->payload()->get('email');

        $user = User::where('email', $email)->first();

        if (!$user) {
            return response()->json([
                'message' => 'Unauthorized'
            ], 401);
        }

        $auth->setUser($user);

        return $next($request);
    }
}
