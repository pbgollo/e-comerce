<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class JWTAuthMiddleware
{

    public function handle(Request $request, Closure $next)
    {
        if(!$request->get('user_id')){
            abort(403, 'Unauthorized');
        }

        return $next($request);
    }
}
