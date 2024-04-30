<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    // public function store(LoginRequest $request): RedirectResponse
    // {
    //     $request->authenticate();

    //     $request->session()->regenerate();

    //     return redirect()->intended(RouteServiceProvider::HOME);
    // }

    public function store(LoginRequest $request)
    {
        // Authenticate the user
        $request->authenticate();
    
        // Regenerate the session after authentication
        $request->session()->regenerate();
    
        // Define roles and their corresponding dashboard URLs
        $roles = [
            'admin' => 'admin/dashboard',
            'instructor' => 'instructor/dashboard',
            'user' => '/dashboard',
        ];
    
        // Retrieve the user's role
        $userRole = $request->user()->role;
    
        // Determine the dashboard URL based on the user's role
        $url = $roles[$userRole] ?? '';
    
        activity()->log('Login Successfully');

        // Notification message for successful login
        $notification = [
            'message' => 'Login Successfully',
            'alert-type' => 'success',
        ];
    
        $request->user()->update([
            // 'last_login_at' => Carbon::now()->toDateTimeString(),
            'last_login_ip' => $request->getClientIp()
        ]);

        // Redirect to the intended URL with the notification
        return redirect()->intended($url)->with($notification);
    }
    

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        activity()->log('Logout Successfully');
        return redirect('/');
    }
}
