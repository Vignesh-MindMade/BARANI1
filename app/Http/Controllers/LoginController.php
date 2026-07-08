<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class LoginController extends Controller
{

    public function showLoginForm()
    {
        return view('auth.login');
    }

    
public function login(Request $request)
{
    // Validate the request
    $request->validate([
        'email' => 'required|email',
        'password' => 'required',
    ]);

    // Retrieve user by email
    $user = User::where('email', $request->email)->first();

    // Check if user exists and password matches
    if ($user && Hash::check($request->password, $user->password)) {
        // Log the user in
        Auth::login($user);

        // Regenerate the session to prevent fixation
        $request->session()->regenerate();

        // Redirect to intended page
        return redirect()->intended('menus.index');
    }

    // If authentication fails, redirect back with error message
    return back()->withErrors([
        'email' => 'The provided credentials do not match our records.',
    ]);
}

    // Handle logout
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
