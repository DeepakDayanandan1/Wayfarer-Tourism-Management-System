<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function index()
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $user = Auth::user();
        return view('profile.index', compact('user'));
    }

    public function update(Request $request)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $user = Auth::user();

        // Support both legacy inputs ('name', 'mobileno') and standard inputs ('FullName', 'MobileNumber')
        $fullName = $request->input('FullName', $request->input('name'));
        $mobileNumber = $request->input('MobileNumber', $request->input('mobileno'));

        $request->merge([
            'FullName' => $fullName,
            'MobileNumber' => $mobileNumber,
        ]);

        $request->validate([
            'FullName' => 'required|string|max:100',
            'MobileNumber' => 'required|digits:10',
        ]);

        $user->update([
            'FullName' => $fullName,
            'MobileNumber' => $mobileNumber,
        ]);

        return back()->with('success', 'Profile updated successfully.');
    }

    public function changePasswordForm()
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        return view('profile.change-password');
    }

    public function updatePassword(Request $request)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        // Support legacy inputs ('password', 'newpassword', 'confirmpassword')
        if ($request->has('password') && !$request->has('current_password')) {
            $request->merge(['current_password' => $request->password]);
        }
        if ($request->has('newpassword') && !$request->has('new_password')) {
            $request->merge([
                'new_password' => $request->newpassword,
                'new_password_confirmation' => $request->confirmpassword,
            ]);
        }

        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:4|confirmed',
        ]);

        $user = Auth::user();
        $currentPassword = (string) $request->current_password;
        $storedPassword = (string) $user->Password;
        $isCurrentValid = false;

        // 1. Bcrypt / Argon hash check
        if (str_starts_with($storedPassword, '$2y$') || str_starts_with($storedPassword, '$2a$') || str_starts_with($storedPassword, '$2b$') || str_starts_with($storedPassword, '$argon')) {
            try {
                $isCurrentValid = Hash::check($currentPassword, $storedPassword);
            } catch (\Throwable $e) {
                $isCurrentValid = false;
            }
        }
        // 2. Legacy MD5 hash check
        elseif (hash_equals(md5($currentPassword), $storedPassword)) {
            $isCurrentValid = true;
        }
        // 3. Plaintext match
        elseif (hash_equals($currentPassword, $storedPassword)) {
            $isCurrentValid = true;
        }

        if (!$isCurrentValid) {
            return back()->withErrors(['current_password' => 'The provided current password does not match our records.']);
        }

        $user->update([
            'Password' => Hash::make($request->new_password),
        ]);

        return back()->with('success', 'Password changed successfully!');
    }
}
