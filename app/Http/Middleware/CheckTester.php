<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use URL;
class CheckTester
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
        if (!isset(Auth::user()->tester) || !Auth::user()->tester) {
            session(['backUrl' => URL::previous()]);
            return redirect('/home');
        }
        return $next($request);
    }
}
