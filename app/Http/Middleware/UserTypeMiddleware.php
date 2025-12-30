<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class UserTypeMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $requiredUserType): Response
    {
        // 1. Check if user is logged in
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        // 2. Check if their ID matches the requirement
        // (e.g., if route requires type 3, but user is type 1, block them)
        if (auth()->user()->usertype_id != $requiredUserType) {
            abort(403, 'Unauthorized access: You do not have the right permissions.');
        }

        return $next($request);
    }
}