<?php

namespace App\Http\Middleware;

use Closure;
use Exception;
use Illuminate\Http\Request;

class SwaggerVerify
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        // local 환경 이거나 SHOW_SWAGGER_DOCUMENT=true 일때만 접근 허용
        if (config('app.env') != 'local' && !config('app.swagger.show')) {
            abort(404);
        }

        return $next($request);
    }
}
