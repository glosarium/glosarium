<?php

namespace App\Http\Middleware;

use Closure;

class Cors
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
        if (app()->environment('production')) {
            $domains = implode(', ', [
                'http://www.glosarium.web.id',
                'http://glosarium.web.id',
            ]);
        } else {
            $domains = '*';
        }

        return $next($request)
            ->header('Access-Control-Allow-Origin', $domains)
            ->header('Access-Control-Allow-Methods', '*')
            ->header('Access-Control-Expose-Headers', 'authorization');
    }
}
