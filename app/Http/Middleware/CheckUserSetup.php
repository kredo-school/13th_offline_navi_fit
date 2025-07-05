<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckUserSetup
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Skip check for non-authenticated users
        if (! auth()->check()) {
            return $next($request);
        }

        // Skip check for setup-related routes
        $excludedRoutes = [
            'profile.*',
            'goal.*',
            'logout',
            'login',
            'register',
        ];

        foreach ($excludedRoutes as $route) {
            if ($request->routeIs($route)) {
                return $next($request);
            }
        }

        $user = auth()->user();

        // check if profile exists
        if (! $user->profile) {
            return redirect()->route('profile.create')
                ->with('message', 'Please complete your profile first.');
        }

        // Check if goals exist
        if (! $user->goals()->exists()) {
            return redirect()->route('goal.create')
                ->with('message', 'Please set your fitness goals.');
        }

        return $next($request);
    }
}
