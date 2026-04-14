<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * Show the login form
     */
    public function showLoginForm()
    {
        return view('auth.login');
    }

    /**
     * Handle login
     */
    public function login(Request $request)
    {
        // Validate the form data
        $credentials = $request->validate([
            'username' => 'required',
            'password' => 'required|min:6',
        ]);

        // Try to authenticate with username or email
        $loginField = filter_var($credentials['username'], FILTER_VALIDATE_EMAIL) ? 'email' : 'name';
        
        $loginCredentials = [
            $loginField => $credentials['username'],
            'password' => $credentials['password']
        ];

        // Attempt login
        if (Auth::attempt($loginCredentials, $request->has('remember'))) {
            $request->session()->regenerate();
            
            // DEBUG: Log admin check
            $user = Auth::user();
            \Log::info('Login: User=' . $user->email . ', is_admin=' . ($user->is_admin ?? 'NULL') . ', isAdmin()=' . ($user->isAdmin() ? 'true' : 'false'));
            
            // Check if admin
            if ($user->isAdmin()) {
                \Log::info('Redirecting to ADMIN dashboard');
                return redirect()->route('admin.dashboard');
            }
            
            \Log::info('Redirecting to USER dashboard');
            return redirect()->route('dashboard');
        }

        // Login failed
        return back()->withErrors([
            'username' => 'Invalid credentials.',
        ])->withInput();
    }

    /**
     * Handle logout
     */
    public function logout(Request $request)
    {
        Auth::logout();
        
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        return redirect()->route('login');
    }
}