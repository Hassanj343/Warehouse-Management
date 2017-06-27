<?php namespace App\Http\Middleware;

use Auth;
use Closure;

class Administrator
{


    public function handle($request, Closure $next)
    {
        if (Auth::user()->is_admin) {
            return $next($request);
        }
        return abort(401, 'Unauthorized access');


    }

}
