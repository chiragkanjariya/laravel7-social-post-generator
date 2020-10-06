<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class HasProfile
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
        $profiles = Auth::user()->profiles;
        if (count($profiles) < 1)
        {
            return redirect('/profiles/create');
        }
        return $next($request);
    }
}
