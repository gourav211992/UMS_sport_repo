<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class AdminOrSportsMiddleware
{
    public function handle($request, Closure $next)
    {
        if (Auth::guard('admin')->check() || Auth::guard('sports')->check()) {
            return $next($request);
        }

        return redirect()->route('ums.login');
    }
}