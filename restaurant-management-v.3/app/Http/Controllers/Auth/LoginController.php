<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login'); // Your login view
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        // Check if staff exists with this email
        $staff = DB::table('msStaff')
            ->where('staffEmail', $credentials['email'])
            ->first();

        if (!$staff) {
            return back()->withErrors([
                'email' => 'The provided credentials do not match our records.',
            ])->onlyInput('email');
        }

        // Verify password
        if (!Hash::check($credentials['password'], $staff->staffPassword)) {
            dd('Password salah atau belum di-hash', $staff->staffPassword);
        }

        // Manual login (since we're not using Eloquent)
        // Login
        Auth::guard('staff')->loginUsingId($staff->staffID);
        return redirect()->intended('dashboard'); // ini lebih aman

    }

    public function logout(Request $request)
    {
        Auth::guard('staff')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}