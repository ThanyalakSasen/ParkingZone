<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminAuthMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $isLogin = Auth::check();
        $isAdmin = Auth::user()->is_admin;

        if ($isLogin && $isAdmin) {
            return $next($request);
        }

        return redirect('/admin/login')->with('error', 'You do not have admin access.');
    }
}
