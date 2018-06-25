<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class CheckAdministrator
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
        if (Auth::user() && Auth::user()->administrator) {
              return $next($request);
        }
        return redirect('/');

    }
}
