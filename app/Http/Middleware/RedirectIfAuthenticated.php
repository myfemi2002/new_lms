<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    // public function handle(Request $request, Closure $next, string ...$guards): Response
    // {
    //     $guards = empty($guards) ? [null] : $guards;

    //     foreach ($guards as $guard) {
    //         if (Auth::guard($guard)->check()) {
    //             return redirect(RouteServiceProvider::HOME);
    //         }
    //     }

    //     return $next($request);
    // }


    // public function handle(Request $request, Closure $next, ...$guards)
    // {
    //     $guards = empty($guards) ? [null] : $guards;

    //     foreach ($guards as $guard) {
    //         if (Auth::guard($guard)->check()) {
    //             return $this->redirectBasedOnRole();
    //         }
    //     }

    //     return $next($request);
    // }

    // protected function redirectBasedOnRole()
    // {
    //     $roles = [           
    //         'admin' => '/admin/dashboard',
    //         'instructor' => '/instructor/dashboard',
    //     ];

    //     $userRole = Auth::user()->role;

    //     if (isset($roles[$userRole])) {
    //         return redirect($roles[$userRole]);
    //     }

    //     // Add a default redirect or handle the case where the role is not recognized
    //     // return redirect('/default-dashboard');
    // }

    public function handle(Request $request, Closure $next, string ...$guards): Response
    {
        $guards = empty($guards) ? [null] : $guards;
        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {

                if(Auth::check() && Auth::user()->role == ''){
                    return redirect('/dashboard');
                }
                if(Auth::check() && Auth::user()->role == 'instructor'){
                    return redirect('/instructor/dashboard');

                }if(Auth::check() && Auth::user()->role == 'admin'){
                    return redirect('/admin/dashboard');
                }
            }
        }
        return $next($request);
    }

}
