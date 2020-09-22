<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class CheckStatus
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
        if (Auth::check())
        {
          if (Auth::User()->status != 'activated')
          {
            Auth::logout();
            return redirect()->to('/login')->with('warning', 'Your session has expired because your account is deactivated.');
          }
        }
        return $next($request);
    }
}
