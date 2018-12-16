<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (Auth::guard($guard)->check()) {
<<<<<<< HEAD
            $s = auth()->user()->Siglas;
            if($s="SSA"){
              return redirect('/Admi');
            }else {
              return redirect('/semiAdmi');
            }
=======
            return redirect('/');
>>>>>>> sports
        }

        return $next($request);
    }
}
