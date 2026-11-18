<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        if (Auth::guard('admin')->check()) {
            return redirect()->route('admin.dashboard');
        }
        return view('admin.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        $loginInput = trim($credentials['username']);
        $admin = Admin::where('UserName', $loginInput)
            ->orWhere('EmailId', $loginInput)
            ->first();

        if ($admin) {
            $inputPassword = (string) $credentials['password'];
            $storedPassword = (string) $admin->Password;
            $matched = false;

            // 1. Bcrypt / Argon hash check
            if (str_starts_with($storedPassword, '$2y$') || str_starts_with($storedPassword, '$2a$') || str_starts_with($storedPassword, '$2b$') || str_starts_with($storedPassword, '$argon')) {
                try {
                    $matched = Hash::check($inputPassword, $storedPassword);
                } catch (\Throwable $e) {
                    $matched = false;
                }
            }
            // 2. Legacy Core PHP MD5 hash check
            elseif (hash_equals(md5($inputPassword), $storedPassword)) {
                $matched = true;
                // Auto-upgrade legacy MD5 hash to Bcrypt
                $admin->update(['Password' => Hash::make($inputPassword)]);
            }
            // 3. Legacy Plaintext password check
            elseif (hash_equals($inputPassword, $storedPassword)) {
                $matched = true;
                // Auto-upgrade plaintext to Bcrypt
                $admin->update(['Password' => Hash::make($inputPassword)]);
            }

            if ($matched) {
                Auth::guard('admin')->login($admin);
                $request->session()->regenerate();
                return redirect()->intended(route('admin.dashboard'))->with('success', 'Welcome to Admin Dashboard, ' . $admin->Name . '!');
            }
        }

        return back()->withErrors([
            'username' => 'Invalid admin username or password.',
        ])->onlyInput('username');
    }

    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('admin.login')->with('success', 'Logged out of admin panel.');
    }

    public function showForgotPassword()
    {
        return view('admin.forgot-password');
    }

    public function forgotPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'mobile' => 'required|digits:10',
            'new_password' => 'required|min:4|confirmed',
        ]);

        $admin = Admin::where('EmailId', $request->email)
            ->where('MobileNumber', $request->mobile)
            ->first();

        if (!$admin) {
            return back()->withErrors(['email' => 'No admin account found with those credentials.']);
        }

        $admin->update([
            'Password' => Hash::make($request->new_password),
        ]);

        return redirect()->route('admin.login')->with('success', 'Admin password reset successfully! Please log in.');
    }
}

