<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\User; 
use Illuminate\Http\Request; 
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class StaffController extends Controller
{
    public function admin()
    {
        return view('layouts.app');
    }

    public function index()
    {
        return view('auth.register');
    }

    public function store(Request $request)
    {
        // Validation
        $request->validate([
            'name'          => 'required|string|max:100',
            'mobile_number' => 'required|string|max:15|unique:users,mobile_number',
            'email'         => 'required|email|max:150|unique:users,email',
            'password'      => 'required|min:6',
        ]);

        // Create user
        $user = new User();
        $user->name = $request->name;
        $user->mobile_number = $request->mobile_number;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();

        return redirect()->back()->with('success', 'User created successfully.');
    }
    public function showLoginForm()
        {
            return view('auth.login');
        }
  public function login(Request $request)
    {
        // Validate input
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required|min:6'
        ]);

        // Attempt login
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $request->session()->regenerate();
            return redirect()->intended('/dashboard')->with('success', 'Logged in successfully');
        }

        // If failed
        return back()->withErrors([
            'email' => 'Invalid email or password.',
        ])->onlyInput('email');
    }
}
