<?php

namespace App\Http\Middleware;

use Closure;
use JWTAuth;

class Api
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure                 $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (!JWTAuth::getToken()) {
            exit('a');
        }

        return $next($request);
    }
}
