<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\User;

class Role
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    

    public function handle(Request $request, Closure $next, $role ): Response
    
    {
        // Check if the user's role matches the expected role
        if ($request->user()->role !== $role) {
            return redirect('dashboard');
        }
    
        // Continue with the next middleware or route handler
        return $next($request);
    }
}
