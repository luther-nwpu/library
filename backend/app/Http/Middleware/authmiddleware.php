<?php

namespace App\Http\Middleware;

use Closure;

class authmiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(session('id')){
            return $next($request);
        } else {
            return response()->json(['logined' => 0], 200);
        }
    }
}
