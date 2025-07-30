<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        // Redirect to admin login page if user is not logged in
        if (! auth()->check()) {
            return redirect()->route('admin.login');
        }

        // Redirect to admin login page if user is not an admin
        if (! auth()->user()->is_admin) {
            auth()->logout();

            return redirect()->route('admin.login')->with('error', 'Admin privileges required.');
        }

        return $next($request);
    }
}
