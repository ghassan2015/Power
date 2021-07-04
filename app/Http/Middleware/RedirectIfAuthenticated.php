<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @param string|null $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if ($guard == "customer" && Auth::guard($guard)->check()) {
            return redirect('/Customers/Invoice');
        }

        if (Auth::guard($guard)->check()) {
            return redirect('/Dashboard/Boxs');
        }

        return $next($request);

    }

}
