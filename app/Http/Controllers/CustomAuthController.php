<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Hash;
use Session;
use App\Models\User;
use App\Models\ContactForm;
use App\Models\JobApplication;
use App\Models\SupplierRegistration;
use App\Models\BrochureLead;
use Illuminate\Support\Facades\Auth;

class CustomAuthController extends Controller
{
    public function home()
    {
        return view('frontend.home.index');
    }

    public function admin()
    {

        if (Auth::check()) {
            return view('layouts.app');
        } else {
            return redirect()->route('login');
        }
    }

    public function index()
    {
        return view('Auth.login');
    }


    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            return redirect()->intended('dashboard')
                ->with('message', 'Signed in!');
        }

          return redirect()->route('login')->with('success', 'Profile updated successfully.');
    }

    public function dashboard()
    {
        if (Auth::check()) {
            $contactCount = ContactForm::count();
            $JobApplications = JobApplication::count();
            $SupplierRegistrationcount = SupplierRegistration::count();
            $BrochureLeadsCount = BrochureLead::count();

            return view('layouts.dashboard', compact('contactCount', 'JobApplications', 'SupplierRegistrationcount', 'BrochureLeadsCount'));
        } else {
            return redirect()->route('login');
        }
    }

    public function profileIndex()
    {
        return view('profile.user-profile');
    }

    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'mobilenumber' => 'required|digits:10',
        ]);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'mobilenumber' => $request->mobilenumber,
        ]);

        if ($request->filled('password')) {
            $user->update(['password' => Hash::make($request->password)]);
        }

        return redirect()->route('profile.index')->with('success', 'Profile updated successfully.');
    }

    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('users.index')->with('success', 'User deleted successfully.');
    }
}
