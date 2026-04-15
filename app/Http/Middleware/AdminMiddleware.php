<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

// Middleware that restricts access to admin-only routes
// Attach this to any route or route group that only admins should be able to reach
class AdminMiddleware
{
    // Runs on every request that passes through this middleware
    // If the logged-in user is not an admin, they are blocked immediately
    public function handle(Request $request, Closure $next): Response
    {
        // Check the user's role — if it's not 'admin', deny access with a 403 Forbidden error
        if (auth()->user()->role !== 'admin') {
            abort(403, 'Access denied');
        }

        // User is an admin, so allow the request to continue to its intended route
        return $next($request);
    }
}