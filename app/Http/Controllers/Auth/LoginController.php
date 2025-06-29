<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * Show the application's login form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showLoginForm()
    {
        return view('auth.login'); 
    }

    /**
     * Handle a login request to the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        // Validate the login request
        $validator = Validator::make($request->all(), [
            'username' => 'required|string',
            'password' => 'required|string|min:6',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                           ->withErrors($validator)
                           ->withInput($request->only('username'));
        }

        // Get the login credentials (using username instead of email)
        $credentials = $request->only('username', 'password');
        $remember = $request->has('remember');

        // Attempt to log the user in
        if (Auth::attempt($credentials, $remember)) {
            // Authentication passed
            $request->session()->regenerate();

            $user = Auth::user();

            // Redirect based on user role
            if ($user->isAdmin()) {
                return redirect()->route('admin.dashboard')
                               ->with('login_success', 'Welcome back, Admin ' . $user->name . '!');
            } else {
                return redirect()->route('index')
                               ->with('login_success', 'Welcome back, ' . $user->name . '!');
            }
        }

        // Authentication failed
        return redirect()->back()
                       ->withErrors([
                           'username' => 'The provided credentials do not match our records.',
                       ])
                       ->withInput($request->only('username'));
    }

    /**
     * Log the user out of the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout(Request $request)
    {   
        $userName = Auth::user()->name ?? 'User';

        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('home')
                       ->with('success', 'You have been logged out successfully.');
    }

    /**
     * Get the post-login redirect path based on user role.
     *
     * @return string
     */
    protected function redirectTo()
    {
        if (auth()->check() && auth()->user()->isAdmin()) {
            return route('admin.dashboard');
        }
        
        return route('index');
    }
}