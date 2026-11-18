<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        if (Auth::check()) {
            return redirect()->route('home');
        }
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $loginInput = trim($credentials['email']);
        $user = User::where('EmailId', $loginInput)
            ->orWhere('MobileNumber', $loginInput)
            ->first();

        if ($user) {
            $inputPassword = (string) $credentials['password'];
            $storedPassword = (string) $user->Password;
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
                $user->update(['Password' => Hash::make($inputPassword)]);
            }
            // 3. Legacy Plaintext password check
            elseif (hash_equals($inputPassword, $storedPassword)) {
                $matched = true;
                // Auto-upgrade plaintext to Bcrypt
                $user->update(['Password' => Hash::make($inputPassword)]);
            }

            if ($matched) {
                Auth::login($user);
                $request->session()->regenerate();
                return redirect()->intended(route('home'))->with('success', 'Welcome back, ' . ($user->FullName ?: $user->EmailId) . '!');
            }
        }

        return back()->withErrors([
            'email' => 'Invalid email or password.',
        ])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('home')->with('success', 'You have been logged out successfully.');
    }

    public function checkEmail(Request $request)
    {
        $exists = User::where('EmailId', $request->email)->exists();
        return response()->json([
            'available' => !$exists,
            'message' => $exists ? 'Email already registered.' : 'Email is available for registration.'
        ]);
    }
}

