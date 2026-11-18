<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function index()
    {
        $admin = Auth::guard('admin')->user();
        return view('admin.profile.index', compact('admin'));
    }

    public function update(Request $request)
    {
        $admin = Auth::guard('admin')->user();

        $validated = $request->validate([
            'name' => 'required|string|max:250',
            'email' => 'required|email|max:250',
            'mobile' => 'required|digits:10',
        ]);

        $admin->update([
            'Name' => $validated['name'],
            'EmailId' => $validated['email'],
            'MobileNumber' => $validated['mobile'],
        ]);

        return back()->with('success', 'Admin profile updated successfully.');
    }

    public function changePassword()
    {
        return view('admin.profile.change-password');
    }

    public function updatePassword(Request $request)
    {
        if ($request->has('password') && !$request->has('current_password')) {
            $request->merge(['current_password' => $request->password]);
        }
        if ($request->has('newpassword') && !$request->has('new_password')) {
            $request->merge([
                'new_password' => $request->newpassword,
                'new_password_confirmation' => $request->confirmpassword,
            ]);
        }

        $admin = Auth::guard('admin')->user();

        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:4|confirmed',
        ]);

        $currentPassword = (string) $request->current_password;
        $storedPassword = (string) $admin->Password;
        $isValid = false;

        if (str_starts_with($storedPassword, '$2y$') || str_starts_with($storedPassword, '$2a$') || str_starts_with($storedPassword, '$2b$') || str_starts_with($storedPassword, '$argon')) {
            try {
                $isValid = Hash::check($currentPassword, $storedPassword);
            } catch (\Throwable $e) {
                $isValid = false;
            }
        } elseif (hash_equals(md5($currentPassword), $storedPassword)) {
            $isValid = true;
        } elseif (hash_equals($currentPassword, $storedPassword)) {
            $isValid = true;
        }

        if (!$isValid) {
            return back()->withErrors(['current_password' => 'Current password is incorrect.']);
        }

        $admin->update([
            'Password' => Hash::make($request->new_password),
        ]);

        return back()->with('success', 'Admin password changed successfully!');
    }
}

